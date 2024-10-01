<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use App\Models\Transaction;

class TransactionNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Transaction Alert')
            ->line('Your transaction of '.$this->transaction->amount.' has been '.$this->transaction->status)
            ->action('View Transaction', url('/transactions/'.$this->transaction->id))
            ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            'transaction_id' => $this->transaction->id,
            'amount' => $this->transaction->amount,
            'transaction_type' => $this->transaction->transaction_type,
            'status' => $this->transaction->status,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'transaction_id' => $this->transaction->id,
            'amount' => $this->transaction->amount,
            'transaction_type' => $this->transaction->transaction_type,
            'status' => $this->transaction->status,
        ]);
    }
}
