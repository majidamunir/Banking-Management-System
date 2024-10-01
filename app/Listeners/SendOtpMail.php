<?php

namespace App\Listeners;

use App\Events\OtpSent;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;

class SendOtpMail
{
    public function handle(OtpSent $event)
    {
        Mail::to($event->user->email)->send(new OtpMail($event->otp));
    }
}
