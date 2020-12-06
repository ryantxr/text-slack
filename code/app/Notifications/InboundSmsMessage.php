<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
use TextSlack\RequestParser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class InboundSmsMessage extends Notification
{
    use Queueable;

    public $from;
    public $to;
    public $message;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        // Log::debug('JSON: '. $request->json());
        $this->to = $request->input('0.to');
        $this->from = $request->input('0.message.from');
        $this->message = $request->input('0.message.text');

        // $a = $request->all();
        // $b = $a[0];
        // $this->to = $b['to'];
        // $message = $b['message'];
        // Log::debug(__METHOD__ . ": " . print_r($message, true));
        // $this->from = $message['from'];
        // $this->message = $message['text'];
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    /**
     * Get the slack representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\SlackMessage
     */
    public function toSlack($notifiable)
    {
        return (new SlackMessage)
                // ->to('#other') // specify which channel
                ->content(sprintf("SMS received from %s\nto: %s\nmessage:\n`%s`", $this->from, $this->to, $this->message));
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
