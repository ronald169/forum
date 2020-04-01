<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CourseCreated extends Notification
{
    use Queueable;

    protected $course;

    public function __construct($course)
    {
        $this->course = $course;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => $this->course->user->name . ' created a new course  to ' . $this->course->klasse->title,
            'link' => $this->course->path()
        ];
    }
}
