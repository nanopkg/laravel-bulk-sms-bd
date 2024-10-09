<?php

namespace Nanopkg\BulkSmsBd\Contracts;

interface BulkSmsBdNotification
{
    /**
     * Method to prepare the notification data for BulkSmsBd.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toBulkSmsBd($notifiable): array;
}
