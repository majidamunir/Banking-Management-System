<?php

namespace App\Mail;

use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TransactionCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $transaction;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your Transaction has been Created')
            ->view('Admin.transaction.createdEmail')
            ->with([
                'transactionAmount' => $this->transaction->amount,
                'transactionType' => $this->transaction->transaction_type,
                'transactionDate' => $this->transaction->created_at->toFormattedDateString(),
            ]);
    }
}
