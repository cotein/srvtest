<?php

namespace App\Src\Meli\WebHooks;

use Illuminate\Support\Facades\Log;

class FactoryHook
{
    protected $classes = [
        'messages' => 'Message',
        'orders' => 'Order',
        'orders_v2' => 'Order'
    ];

    public function getInstance($wh)
    {
        Log::alert("getInstance");
        $className = $this->classes[$wh->topic];
        Log::alert($className);

        return new $className;
    }
}
