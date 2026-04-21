<?php

namespace App\Notifications;

use App\Models\FreeMasterClass;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class AdminFreeMasterClassNotification extends Notification
{
    use Queueable;

    /**
     * @var \App\Models\FreeMasterClass
     */
    public $free_masterclass;

    /**
     * Create a new notification instance.
     *
     * @param \App\Models\FreeMasterClass $free_masterclass
     */
    public function __construct(FreeMasterClass $free_masterclass)
    {
        $this->free_masterclass = $free_masterclass;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param object $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('New Free Masterclass Request Received')
                    ->view('email.admin-free-masterclass', [
                        'free_masterclass' => $this->free_masterclass,
                    ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param object $notifiable
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [];
    }
}