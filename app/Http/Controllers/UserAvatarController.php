<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserAvatarController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store()
    {
        $this->validate(request(), [
            'avatar' => ['required', 'image']
        ]);

        auth()->user()->update([
            'avatar_path' => request()->file('avatar')->store('avatars', 'public')
            // 'avatar_path' => request()->file('avatar')->storeAs('avatars', uniqid().'png', 'public')
        ]);

        if (request()->isJson()) {
            return response([], 201);
        }

        return back();
    }

}
