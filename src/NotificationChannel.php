<?php

namespace Nasution\ZenzivaSms;

use Nasution\ZenzivaSms\Client as Sms;
use Illuminate\Notifications\Notification;

class NotificationChannel
{
    /**
     * The Zenziva SMS client instance
     *
     * @var \Nasution\ZenzivaSms\Sms
     */
    protected $zenziva;

    /**
     * Create a new Zenziva SMS channel instance.
     *
     * @param \Nasution\ZenzivaSms\Sms $zenziva
     */
    public function __construct(Sms $zenziva)
    {
        $this->zenziva = $zenziva;
    }

    /**
     * Send the given notification
     *
     * @param  mixed $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        if (! $to = $notifiable->routeNotificationFor('zenziva-sms')) {
            return;
        }

        $this->zenziva->send([
            'to'   => $to,
            'text' => (string) $notification,
        ]);
    }
}
