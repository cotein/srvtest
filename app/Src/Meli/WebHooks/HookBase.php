<?php

namespace App\Src\Meli\WebHooks;

use App\Src\Models\Status;
use App\Src\Meli\MeliUsers;
use App\Src\Tools\StdClassTool;
use App\Src\Meli\MeliNotifications;
use App\Src\Models\WebHookResponse;

class HookBase 
{
    protected $notifications;

    public function __construct()
    {
        $this->notifications = new MeliNotifications;

        $this->meli_user = new MeliUsers;
    }

    public function save_response($response, $wh)
    {
        $whR = new WebHookResponse;
        $whR->web_hook_id = $wh->id;
        $whR->response = StdClassTool::toArray($response);
        $whR->status_id = Status::NOTIFICACION_EN_PROCESO;       
        $whR->save();
    }
}
