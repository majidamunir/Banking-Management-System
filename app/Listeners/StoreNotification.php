<?php

namespace App\Listeners;

use App\Events\NotificationCreated;
use App\Models\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class StoreNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(NotificationCreated $event)
    {
        $notification = $event->notification;
        $notification->save();
    }
}

