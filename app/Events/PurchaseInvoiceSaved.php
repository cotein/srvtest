<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PurchaseInvoiceSaved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $pi;

    public function __construct($pi)
    {
        $this->pi = $pi;
    }
    
}
