<?php

namespace App\Mail;

use App\Models\Loan;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoanReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $loan;

    public function __construct(Loan $loan)
    {
        $this->loan = $loan;
    }

    public function build()
    {
        return $this->subject('Loan Submission Reminder')
            ->view('Loan-Repay.mail')
            ->with([
                'loanAmount' => $this->loan->amount,
                'endDate' => $this->loan->end_date,
            ]);
    }
}
