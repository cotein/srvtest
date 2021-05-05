<?php

namespace App\Src\Meli\WebHooks;

use Illuminate\Support\Facades\Log;

class FactoryHook
{
    protected $classes = [
        'messages' => 'Message',
        'orders' => 'Order',
        'orders_v2' => 'Order',
        'payments' => 'Payment',
        'shipments' => 'Shipment',
        'items' => 'Shipment'
    ];

    public function getInstance($wh)
    {
        Log::alert("getInstance");
        Log::alert("lo que instancia");
        Log::alert($wh->topic);
        
        $className =  "App\\Src\\Meli\\WebHooks\\" . $this->classes[$wh->topic];
        Log::alert($className);

        return new $className;
    }
}
