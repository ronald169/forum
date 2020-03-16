<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $search = request('name');

        return User::where('name', 'LIKE', "$search%")
                    ->take(5)
                    ->pluck('name');
    }

}
