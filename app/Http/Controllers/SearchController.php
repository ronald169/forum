<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function show()
    {
        $search = request('q');

        $threads = Thread::search($search)->paginate(25);

        if (request()->expectsJson()) {
            return $threads;
        }

        return view('threads.index', [
            'threads' => $threads
        ]);
    }

}
