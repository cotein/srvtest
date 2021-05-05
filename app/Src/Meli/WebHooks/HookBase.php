<?php

namespace App\Src\Meli\WebHooks;

use App\Src\Meli\MeliUsers;
use App\Src\Meli\MeliNotifications;

class HookBase 
{
    protected $notifications;

    public function __construct()
    {
        $this->notifications = new MeliNotifications;

        $this->meli_user = new MeliUsers;
    }
}
