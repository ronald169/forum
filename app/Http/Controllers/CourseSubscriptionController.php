<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseSubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store($betreuung, Course $course)
    {
        $course->subscribe();
    }

    public function destroy($channelId, Course $course)
    {
        $course->unsubscribe();
    }

}
