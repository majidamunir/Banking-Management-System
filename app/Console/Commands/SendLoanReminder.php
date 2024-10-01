<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Loan;
use Illuminate\Support\Facades\Mail;

class SendLoanReminder extends Command
{
    protected $signature = 'reminders:send-loan';
    protected $description = 'Send loan submission reminders to users 3 or 7 days before the end date';

    public function handle()
    {
        $today = now()->toDateString();
        $loans = Loan::where('reminder_sent', false)
            ->whereIn('end_date', [
                now()->addDays(3)->toDateString(),
                now()->addDays(7)->toDateString(),
            ])
            ->get();

        foreach ($loans as $loan) {
            Mail::to($loan->user->email)->send(new \App\Mail\LoanReminder($loan));
            $loan->reminder_sent = true;
            $loan->save();

            $this->info("Reminder sent to user ID {$loan->user_id} for loan ID {$loan->id}.");
        }

        if ($loans->isEmpty()) {
            $this->info("No reminders to send.");
        }
    }
}
