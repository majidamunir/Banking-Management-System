<?php

namespace App\Events;

use App\Models\Loan;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LoanRequested implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $loan;
    public $user_name;

    public function __construct(Loan $loan)
    {
        $this->loan = $loan;
        $this->user_name = $loan->user->name;
    }

    public function broadcastOn()
    {
        return new Channel('loanChannel');
    }

    public function broadcastAs()
    {
        return 'loan-requested';
    }
}
