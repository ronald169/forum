<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Reply;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Reply $reply)
    {
        $reply->favorite();

        if (request()->wantsJson()) {
            return response([], 200);
        }

        return back();
    }

    public function destroy(Reply $reply)
    {
        $reply->unFavorite();

        if (request()->wantsJson()) {
            return response([], 200);
        }

        return back();
    }

}
