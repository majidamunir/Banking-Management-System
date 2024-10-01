<?php

use App\Console\Commands\FetchExchangeRates;
use App\Console\Commands\SendLoanReminder;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Schedule::command('fetch:exchange-rates')->daily();
Schedule::command('reminders:send-loan')->daily();

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

