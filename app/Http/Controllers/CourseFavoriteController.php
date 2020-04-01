<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseFavoriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store($klass, Course $course)
    {
        $course->favorite();

        if (request()->wantsJson()) {
            return response([], 200);
        }

        return back();
    }

    public function destroy($klass, Course $course)
    {
        $course->unFavorite();

        if (request()->wantsJson()) {
            return response([], 200);
        }

        return back();
    }

}
