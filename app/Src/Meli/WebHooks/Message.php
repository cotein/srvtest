<?php

namespace App\Src\Meli\WebHooks;

use App\User;
use App\Src\Models\Status;
use App\Src\Tools\StdClassTool;
use App\Src\Models\WebHookMessages;
use Illuminate\Support\Facades\Log;
use App\Src\Meli\WebHooks\HookContract;
use App\Events\WebHookMessageWasReceived;
use App\Transformers\Meli\WebHookMessageTransformer;

class Message extends HookBase implements HookContract
{
    public function response_handle($wh)
    {
        $user = User::find(1);
        if($user->verify_expiration_time_token())
        {

            $meli_data = $this->meli_user->refresh_token($user->company->mercadoLibre->meli_refresh_token); 
            
            $user->updateDataWithRefreshToken($meli_data);
        }
        
        Log::info('EN CLASS MESSAGE response handle');
        
        $response = $this->notifications->notification_resource($user->company->mercadoLibre->meli_token, $wh->meli_info['topic'] . '/' .$wh->meli_info['resource']);

        $response = StdClassTool::toArray($response);

        $message = new WebHookMessages;
        $message->message_id = (array_key_exists('message_id', $response['body'])) ? $response['body']['message_id'] : null; 
        $message->send_user_id = (array_key_exists('send_user_id', $response['body'])) ? $response['body']['send_user_id'] : null; 
        $message->send_user_email = (array_key_exists('send_user_email', $response['body'])) ? $response['body']['send_user_email'] : null; 
        $message->receive_user_id = (array_key_exists('receive_user_id', $response['body'])) ? $response['body']['receive_user_id'] : null; 
        $message->receive_user_email = (array_key_exists('receive_user_email', $response['body'])) ? $response['body']['receive_user_email'] : null; 
        $message->text = (array_key_exists('text', $response['body'])) ? is_array($response['body']['text'])? json_encode($response['body']['text']) : $response['body']['text'] : null;
        $message->plain = (array_key_exists('plain', $response['body'])) ? $response['body']['plain'] : null; 
        $message->status = (array_key_exists('status', $response['body'])) ? $response['body']['status'] : null; 
        $message->site_id = (array_key_exists('site_id', $response['body'])) ? $response['body']['site_id'] : null; 
        $message->date = (array_key_exists('date', $response['body'])) ? $response['body']['date'] : null; 
        $message->date_created = (array_key_exists('date_created', $response['body'])) ? $response['body']['date_created'] : null; 
        $message->date_received = (array_key_exists('date_received', $response['body'])) ? $response['body']['date_received'] : null; 
        $message->date_available = (array_key_exists('date_available', $response['body'])) ? $response['body']['date_available'] : null; 
        $message->date_notified = (array_key_exists('date_notified', $response['body'])) ? $response['body']['date_notified'] : null; 
        $message->date_read = (array_key_exists('date_read', $response['body'])) ? $response['body']['date_read'] : null; 
        $message->from = (array_key_exists('from', $response['body'])) ? is_array($response['body']['from'])? json_encode($response['body']['from']) : $response['body']['from'] : null;
        $message->to = (array_key_exists('to', $response['body'])) ? is_array($response['body']['to'])? json_encode($response['body']['to']) : $response['body']['to'] : null;
        $message->moderation = (array_key_exists('moderation', $response['body'])) ? is_array($response['body']['moderation'])? json_encode($response['body']['moderation']) : $response['body']['moderation'] : null;
        $message->hold = (array_key_exists('hold', $response['body'])) ? $response['body']['hold'] : null; 
        $message->answer = (array_key_exists('answer', $response['body'])) ? $response['body']['answer'] : null; 
        $message->name = (array_key_exists('name', $response['body'])) ? $response['body']['name'] : null; 
        $message->subject = (array_key_exists('subject', $response['body'])) ? $response['body']['subject'] : null; 
        $message->resource = (array_key_exists('resource', $response['body'])) ? $response['body']['resource'] : null; 
        $message->resource_id = (array_key_exists('resource_id', $response['body'])) ? $response['body']['resource_id'] : null; 
        $message->client_id = (array_key_exists('client_id', $response['body'])) ? $response['body']['client_id'] : null; 
        $message->status_id = Status::NOTIFICACION_EN_PROCESO;
        $message->save();
        
        $msg =  fractal($message, new WebHookMessageTransformer())->toArray()['data'];

        broadcast(new WebHookMessageWasReceived($msg));

        $this->save_response($response, $wh);

        Log::info('#########################################');
        Log::info('############ NUEVO MENSAJE ################');
        Log::info('#########################################');
        Log::info($response);
        Log::info('#########################################');
        Log::info('#########################################');
        Log::info('#########################################');
    }
}
