<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ThreadWasUpdated extends Notification
{
    use Queueable;

    protected $reply;

    public function __construct($reply)
    {
        $this->reply = $reply;
    }

    public function via($notifiable)
    {
        return ['database'];
    }



    public function toArray($notifiable)
    {
        return [
            'message' => $this->reply->user->name . ' replied to ' . $this->reply->thread->title,
            'link' => $this->reply->path()
        ];
    }
}
