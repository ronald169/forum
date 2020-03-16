<?php

namespace App\Listeners;

use App\Events\ThreadReceivedNewReply;
use App\Notifications\YouWereMentioned;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyMentionedUsers
{

    public function __construct()
    {
        //
    }

    public function handle(ThreadReceivedNewReply $event)
    {

//        $event->reply->thread->subscriptions
//            ->where('user_id', '!=', $event->reply->user_id)
//            ->each
//            ->notify($event->reply);

        User::whereIn('name', $event->reply->mentionedUsers())
            ->get()
            ->each(function ($user) use ($event) {
                $user->notify(new YouWereMentioned($event->reply));
            });
    }
}
