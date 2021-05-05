<?php

namespace App\Src\Meli\WebHooks;

use App\User;
use App\Src\Models\Status;
use App\Src\Models\WebHook;
use App\Src\Models\Customer;
use App\Src\Tools\StdClassTool;
use App\Src\Models\PedidoCliente;
use App\Src\Meli\WebHooks\HookBase;
use Illuminate\Support\Facades\Log;
use App\Events\WebHookOrderWasReceived;
use App\Src\Meli\WebHooks\HookContract;
use Illuminate\Database\Eloquent\Model;
use App\Transformers\PedidoCliente\PedidoClienteListTransformer;

class Order extends HookBase implements HookContract
{
    public function response_handle($wh)
    {
        $user = User::find(1);
        
        if($user->verify_expiration_time_token())
        {

            $meli_data = $this->meli_user->refresh_token($user->company->mercadoLibre->meli_refresh_token); 
            
            $user->updateDataWithRefreshToken($meli_data);
        }
        
        $response = $this->notifications->notification_resource($user->company->mercadoLibre->meli_token, $wh->resource);
        Log::info('#########################################');
        Log::info('############ NUEVA ORDEN ################');
        Log::info('#########################################');
        Log::info($response);
        Log::info('#########################################');
        Log::info('#########################################');
        Log::info('#########################################');
        $ord = StdClassTool::toArray($response['body']);

        $wh_prueba = new WebHook;
        $wh_prueba->meli_info = $ord;
        $wh_prueba->save();
        $wh_prueba->refresh();

        $customer_id = null;

        $cstmr = Customer::where('meli_id', $ord['buyer']['id'])->get();

        if ($cstmr->isEmpty()) {

            $phone = (array_key_exists('phone', $ord['buyer'])) ? $ord['buyer']['phone']['area_code'] . ' '. $ord['buyer']['phone']['number'] : 'Sin informar';
            
            $customer = new Customer;
            $customer->name = $ord['buyer']['last_name'] . ' ' . $ord['buyer']['first_name'];
            $customer->meli_nick = $ord['buyer']['nickname'];
            $customer->meli_id = $ord['buyer']['id'];
            $customer->email = $ord['buyer']['email'];
            $customer->number = $ord['buyer']['billing_info']['doc_number'];
            $customer->phone_1 = $phone;
            
            $customer->save();

            $customer_id = $customer->id;
            
        }else{

            $customer_id = $cstmr->first()->id;
        }

        sleep(1);

        $or = PedidoCliente::where('meli_id', $ord['id'])->get();

        if ($or->isEmpty()) {

            $pc = new PedidoCliente;
            $pc->customer_id = $customer_id;
            $pc->meli_id = $ord['id'];
            $pc->is_meli_order = true;
            $pc->meli_data = $ord;
            $pc->status_id = Status::PENDIENTE;
            $pc->user_id = 999999; //AUTOMATICO
            $pc->save();
            $pc->code = 'PD-' . $this->createDate($ord['date_created']) . '-' . $pc->customer_id . '-' . $pc->id;
            $pc->number = $pc->id;
            $pc->save();

            $pc->refresh();
            
            $pedido = fractal($pc, new PedidoClienteListTransformer())->toArray()['data'];
            $pedido['now'] = true;
            broadcast(new WebHookOrderWasReceived($pedido));

        }else{
            Log::info('############## LA ORDEN YA EXISTIA ###########################');
            Log::info(gettype($or));
            Log::info($or);
            Log::info('#########################################');
        }

        $this->save_response($response, $wh);
    }
}
