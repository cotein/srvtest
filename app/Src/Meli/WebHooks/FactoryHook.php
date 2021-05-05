<?php

namespace App\Src\Meli\WebHooks;

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
        $className = $classes[$wh->topic];
        Log::alert($className);

        return new $className;
    }
}
