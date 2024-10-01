<?php
namespace App\Listeners;

use App\Events\LoanRejected;
use App\Mail\LoanRejectionMail;
use Illuminate\Support\Facades\Mail;

class SendLoanRejection
{
    public function handle(LoanRejected $event)
    {
        $loan = $event->loan;
        Mail::to($loan->user->email)->send(new LoanRejectionMail($loan));
    }
}

