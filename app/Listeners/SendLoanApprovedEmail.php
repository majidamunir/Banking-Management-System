<?php

namespace App\Listeners;

use App\Events\LoanApprovedEvent;
use App\Mail\LoanApprovedMail;
use Illuminate\Support\Facades\Mail;

class SendLoanApprovedEmail
{
    /**
     * Handle the event.
     *
     * @param LoanApprovedEvent $event
     * @return void
     */
    public function handle(LoanApprovedEvent $event)
    {
        $loan = $event->loan;
        Mail::to($loan->user->email)->send(new LoanApprovedMail($loan));
    }
}
