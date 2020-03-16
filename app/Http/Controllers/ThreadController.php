<?php

namespace App\Http\Controllers;

use App\Filters\ThreadFilters;
use App\Models\Channel;
use App\Rules\Recaptcha;
use Illuminate\Http\Request;
use App\Models\Thread;


class ThreadController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'index']);
    }

    public function index(Channel $channel, ThreadFilters $filters)
    {

        $threads = $this->getThreads($channel, $filters);

        return view('threads.index')
                    ->with('threads', $threads);
    }

    public function show($channel, Thread $thread)
    {
        if (auth()->check()) {
            auth()->user()->read($thread);
        }

        $thread->increment('visits');

        return view('threads.show')->with(['thread' => $thread]);
    }

    public function store(Recaptcha $recaptcha)
    {
        $this->validate(request(), [
            'title' => 'required|spamFree',
            'body' => 'required|spamFree',
            'channel_id' => 'required|exists:channels,id',
            'g-recaptcha-response' => ['required', $recaptcha]
        ]);

        $thread = auth()->user()->threads()->create(
            [
                'channel_id' => request()->channel_id,
                'title' => request()->title,
                'body' => request()->body,
                'slug' => request()->title,
            ]
        );

        return redirect($thread->path())
                    ->with('flash', 'Your thread has been published');
    }

    public function create()
    {
        return view('threads.create');
    }

    /**
     * @param Channel $channel
     * @param ThreadFilters $filters
     * @return mixed
     */
    protected function getThreads(Channel $channel, ThreadFilters $filters)
    {
        $threads = Thread::with('channel')->latest()->filter($filters);

        if ($channel->exists) {
            $threads->where('channel_id', $channel->id);
        }

//        $threads = $threads->get();
        return $threads->paginate(5);
    }

    public function destroy($channel, Thread $thread)
    {

        $this->authorize('delete', $thread);

        $thread->delete();

        if (request()->wantsJson())
        {
            return response([], 200);
        }

        return redirect('/threads');
    }

    public function validateThread()
    {
        $this->validate(request(), [
            'title' => 'required|spamFree',
            'body' => 'required|spamFree',
            'channel_id' => 'required|exists:channels,id',
//            'g-recaptcha-response' => new Recaptcha()
        ]);

    }

    public function update($channel, Thread $thread)
    {
        $this->authorize('update', $thread);

        request()->validate(
            [
                'title' => 'required|spamFree',
                'body' => 'required|spamFree'
            ]);

         $thread->update(request()->input());

         return $thread;
    }

}
