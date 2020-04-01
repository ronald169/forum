<?php

namespace App\Http\Controllers;

use App\Models\CommunityLink;
use Illuminate\Http\Request;

class LinkFavoriteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(CommunityLink $link)
    {
        $link->favorite();

        if (request()->wantsJson()) {
            return response([], 200);
        }

        return back();
    }

    public function destroy(CommunityLink $link)
    {
        $link->unFavorite();

        if (request()->wantsJson()) {
            return response([], 200);
        }

        return back();
    }

}
