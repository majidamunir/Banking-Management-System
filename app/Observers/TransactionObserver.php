<?php

namespace App\Observers;

use App\Models\Transaction;
use App\Mail\TransactionCreatedMail;
use Illuminate\Support\Facades\Mail;

class TransactionObserver
{
    public function created(Transaction $transaction)
    {
//        $user = $transaction->account->user;
//
//        if ($user) {
//            Mail::to($user->email)->send(new TransactionCreatedMail($transaction));
//        }
    }
}
