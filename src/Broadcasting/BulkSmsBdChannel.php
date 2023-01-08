<?php

namespace Nanopkg\LaravelBulkSmsBd\Broadcasting;

use Illuminate\Notifications\Notification;
use Nanopkg\LaravelBulkSmsBd\Jobs\BulkSmsBdOneToOne;

/**
 * Class LaravelBulkSmsBdChannel
 *
 * @author IQBAL HASAN <iqbalhasan.dev@gmail.com>
 *
 * @link https://iqbalhasan.dev Author Homepage
 *
 * @license LICENSE The MIT License
 */
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
