<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostForm;
use App\Models\Reply;
use App\Models\Thread;
use App\Notifications\YouWereMentioned;
use App\Spams\Spam;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ReplyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }

    public function index($schannelId, Thread $thread)
    {
        return $thread->replies()->latest()->paginate(4);
    }

    public function store($channelId, Thread $thread, CreatePostForm $form)
    {
        if ($thread->locked) {
            return response('Thread is Locked', 422);
        }

        $reply = $thread->addReply([
                'body' => request('body'),
                'user_id' => auth()->id(),
            ]
        );

        return $reply->load('user');

    }

    public function destroy(Reply $reply)
    {

        $this->authorize('delete', $reply);

        $reply->delete();

        if (request()->wantsJson())
        {
            return response([], 200);
        }

        return back();
    }

    public function update(Reply $reply, CreatePostForm $form)
    {
        $this->authorize('delete', $reply);

        $this->validateReply();

        $reply->update([
            'body' =>request()->body
        ]);

        return response($reply, 201);

    }

    public function validateReply()
    {
        $this->validate(request(), ['body' => 'required|spamFree']);
    }
}
