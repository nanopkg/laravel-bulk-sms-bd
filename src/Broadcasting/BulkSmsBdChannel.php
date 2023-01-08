<?php

namespace Nanopkg\LaravelBulkSmsBd\Broadcasting;

use Illuminate\Notifications\Notification;
use Nanopkg\LaravelBulkSmsBd\Jobs\BulkSmsBdOneToOne;

class BulkSmsBdChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toBulkSmsBd($notifiable);

        if ($notifiable->{config('bulksmsbd.notification_for')}) {
            BulkSmsBdOneToOne::dispatch($notifiable->{config('bulksmsbd.notification_for')}, $message);
        }
    }
}
