<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{

    public function store(Request $request)
    {

        $request->validate([
            'description' => 'required|max:300',
            'date' => 'required|date',
        ]);

        auth()->user()->events()->create([
            'description' => $request->description,
            'date' => $request->date,
            'betreuung_id' => $request->betreuung_id,
        ]);

        if ($request->wantsJson()) {
            return response([], 201);
        }

        return back();
    }

}
