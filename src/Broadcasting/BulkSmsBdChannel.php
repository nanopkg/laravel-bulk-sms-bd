<?php

namespace Nanopkg\BulkSmsBd\Broadcasting;

use Illuminate\Notifications\Notification;
use Nanopkg\BulkSmsBd\Jobs\BulkSmsBdOneToOne;
use Nanopkg\BulkSmsBd\Jobs\BulkSmsBdOneToMany;
use Nanopkg\BulkSmsBd\Contracts\BulkSmsBdNotification;

/**
 * Class BulkSmsBdChannel
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
        if ($notification instanceof BulkSmsBdNotification) {
            $notificationArray = $notification->toBulkSmsBd($notifiable);
            // check if contacts and message key exists in notification array
            if (isset($notificationArray[config('bulksmsbd.notification.contacts')]) && isset($notificationArray[config('bulksmsbd.notification.message')])) {
                if (is_array($notificationArray[config('bulksmsbd.notification.contacts')])) {
                    BulkSmsBdOneToMany::dispatch($notificationArray[config('bulksmsbd.notification.contacts')], $notificationArray[config('bulksmsbd.notification.message')]);
                } else {
                    BulkSmsBdOneToOne::dispatch($notificationArray[config('bulksmsbd.notification.contacts')], $notificationArray[config('bulksmsbd.notification.message')]);
                }
            } else {
                throw new \Exception(config('bulksmsbd.notification.contacts') . ' or ' . config('bulksmsbd.notification.message') . ' not found in Notification array.');
            }
        } else {
            throw new \Exception('Notification is missing toBulkSmsBd method.');
        }
    }
}
