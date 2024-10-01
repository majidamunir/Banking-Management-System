<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TransactionCreationRequested implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $request;

    public function __construct(array $request)
    {
        $this->request = $request;
    }

    public function broadcastOn()
    {
        return new Channel('transactionChannel');
    }

    public function broadcastAs()
    {
        return 'transaction-requested';
    }
}
