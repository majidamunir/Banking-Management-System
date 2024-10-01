<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AccountCreationRequested implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $request;

    public function __construct($request)
    {
        $this->request = $request;
//        dd($request);
    }

    public function broadcastOn()
    {
        return new Channel('accountChannel');
    }

    public function broadcastAs()
    {
        return 'account-creation-requested';
    }
}
