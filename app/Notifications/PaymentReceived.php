<?php

namespace App\Notifications;

use Faker\Provider\Lorem;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;

class PaymentReceived extends Notification
{
    use Queueable;


    protected $amount;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($amount)
    {

        $this->amount = $amount;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // $notifiable lets you determine which user to send the sms to. Usually this is a user object
        // you can do like this: $notifiable->wants_SMS or $notifiable->preferences then you determine
        // when to use nexmo channel.
        // return ['mail', 'database', 'nexmo'];
        return ['mail', 'database'];
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
            ->subject('Your Payment was Received') // Class name is the default subject.
            ->greeting("What's up?") // Hello is the default greeting.
            ->line('The introduction to the notification.')
            ->line(Lorem::sentence(20))
            ->action('Sign up', url('/'))
            ->line('Thanks!');
    }

    /**
     * Get the Vonage / SMS representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\NexmoMessage
     */
    public function toNexmo($notifiable)
    {
        return (new NexmoMessage)
            ->content('Your payment has been processed!'); // customize from number using ->from()
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable 
     * @return array
     */
    public function toArray($notifiable)
    {
        // this will be used by database.
        // in some cases you might have model so you can cast the model into an array
        //$model->toArray()
        return [
            'amount' => $this->amount
        ];
    }
}
