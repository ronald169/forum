<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;

class BestReplyController extends Controller
{

    public function store(Reply $reply)
    {
        abort_if($reply->thread->user_id !== auth()->id(), 403);

        $reply->thread->markBestReply($reply);
    }

}
