<?php

namespace App\Http\Controllers;

use App\User;
use App\Src\Models\Status;
use App\Src\Meli\MeliUsers;
use App\Src\Models\WebHook;
use App\Src\Models\Customer;
use App\Src\Tools\StdClassTool;
use App\Src\Models\PedidoCliente;
use App\Src\Meli\MeliNotifications;
use App\Src\Models\WebHookMessages;
use App\Src\Models\WebHookQuestion;
use App\Src\Models\WebHookResponse;
use App\Src\Traits\DateFormatTrait;
use Illuminate\Support\Facades\Log;
use App\Src\Meli\WebHooks\FactoryHook;
use App\Events\WebHookOrderWasReceived;
use Illuminate\Support\Facades\Response;
use App\Events\WebHookMessageWasReceived;
use App\Events\WebHookQuestionWasReceived;
use App\Transformers\Meli\WebHookMessageTransformer;
use App\Transformers\PedidoCliente\PedidoClienteListTransformer;

class MeliNotificationsController extends Controller
{
    use DateFormatTrait;
    
    protected $notifications;

    protected $meli_user;

    public function __construct()
    {
        $this->notifications = new MeliNotifications;

        $this->meli_user = new MeliUsers;
    }

    public function web_hooks()
    {
        $user = User::find(1);
        if($user->verify_expiration_time_token())
        {

            $meli_data = $this->meli_user->refresh_token($user->company->mercadoLibre->meli_refresh_token); 
            
            $user->updateDataWithRefreshToken($meli_data);
        }
        
        $data = request()->all();

        $wh = new WebHook;
        $wh->meli_info = $data;
        $wh->save();
        $wh->refresh();
        
        $wh->application_id = $wh->meli_info['application_id'];
        $wh->user_id = $wh->meli_info['user_id'];
        $wh->resource = $wh->meli_info['resource'];
        $wh->topic = $wh->meli_info['topic'];
        $wh->sent = $wh->meli_info['sent'];
        $wh->received = $wh->meli_info['received'];
        $wh->attempts = $wh->meli_info['attempts'];
        $wh->status_id = Status::ACTIVO;
        $wh->save();
        $wh->refresh();

        Log::alert("htttttptptptptptp");
        Log::alert(file_get_contents('php://input'));
        Log::alert("htttttptptptptptp");
        http_response_code(200);
        header("HTTP/1.1 200 OK");
        $factory = new FactoryHook;

        $hook = $factory->getInstance($wh);

        $hook->response_handle($wh);
        
        if ($wh->topic == 'questions') {

            $response = $this->notifications->notification_resource($user->company->mercadoLibre->meli_token, $wh->resource);
                
            $response = StdClassTool::toArray($response);
            
            $question = new WebHookQuestion;
            $question->meli_id = (array_key_exists('meli_id', $response['body'])) ? $response['body']['meli_id'] : null;
            $question->seller_id = (array_key_exists('seller_id', $response['body'])) ? $response['body']['seller_id'] : null;
            $question->text = (array_key_exists('text', $response['body'])) ? is_array($response['body']['text'])? json_encode($response['body']['text']) : $response['body']['text'] : null;
            $question->status = (array_key_exists('status', $response['body'])) ? $response['body']['status'] : null;
            $question->item_id = (array_key_exists('item_id', $response['body'])) ? $response['body']['item_id'] : null;
            $question->date_created = (array_key_exists('date_created', $response['body'])) ? $response['body']['date_created'] : null;
            $question->hold = (array_key_exists('hold', $response['body'])) ? $response['body']['hold'] : null;
            $question->deleted_from_listing = (array_key_exists('deleted_from_listing', $response['body'])) ? $response['body']['deleted_from_listing'] : null;
            $question->answer = (array_key_exists('answer', $response['body'])) ? $response['body']['answer'] : null;
            $question->from = (array_key_exists('from', $response['body'])) ? is_array($response['body']['from'])? json_encode($response['body']['from']) : $response['body']['from'] : null;
            $question->email = (array_key_exists('email', $response['body'])) ? $response['body']['email'] : null;
            $question->save();

            broadcast(new WebHookQuestionWasReceived($question));

            $this->save_response($response, $wh);

            //return Response::make('ok', 200);
        }

    }
}

