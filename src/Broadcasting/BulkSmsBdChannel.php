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
        $notificationArray = $notification->toBulkSmsBd($notifiable);
        // check if contacts and message key exists in notification array
        if ($notificationArray[config('bulksmsbd.notification.contacts')] && $notificationArray[config('bulksmsbd.notification.message')]) {
            BulkSmsBdOneToOne::dispatch($notificationArray[config('bulksmsbd.notification.contacts')], $notificationArray[config('bulksmsbd.notification.message')]);
        } else {
            throw new \Exception(config('bulksmsbd.notification.contacts').' or '.config('bulksmsbd.notification.message').' not found in Notification array.');
        }
    }
}
