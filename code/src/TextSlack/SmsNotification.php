<?php
namespace TextSlack;
use Illuminate\Notifications\Notifiable;

class SmsNotification {
    use Notifiable;

    public function routeNotificationForSlack($notification)
    {
        return config('slack.incoming_webhook');
    }
}