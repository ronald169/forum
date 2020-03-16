<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\Request;

class ThreadSubscriptionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store($channel, Thread $thread)
    {
        $thread->subscribe();
    }

    public function destroy($channelId, Thread $thread)
    {
        $thread->unsubscribe();
    }

}
