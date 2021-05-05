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
        $className = $classes[$wh->topic];

        return new $className;
    }
}
