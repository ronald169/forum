<?php

namespace App\Http\Controllers;

use App\Filters\CourseFilters;
use App\Models\Betreuung;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth' )->except(['index', 'show']);
    }

    public function index(Betreuung $betreuung, CourseFilters $filters)
    {
        $courses = $this->getCourses($betreuung, $filters);

        return view('courses.index', [
            'courses' => $courses,
        ]);
    }

    public function show($klass, Course $course)
    {

//        if (auth()->check()) {
//            auth()->user()->read($thread);
//        }

        $course->increment('visits');

        return view('courses.show', [
            'course' => $course
        ]);
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required|spamFree',
            'body' => 'required|spamFree',
            'description' => 'max:300',
            'betreuung' => 'required|exists:betreuungs,secret',
            'class' => 'required|in:6,5,4,3,2c,2a,2g,1c,1d,1a,tc,td,ta,bacc+',
            'matiere' => 'required|in:mathematique,physique,chimie,histoire,geographie,ecm,anglais,francais,informatique,phylosophie,svt,autre'
        ]);

        $b = Betreuung::where('secret', $request->betreuung)->first();

        $course = $b->addCourse([
                    'title' => $request->title,
                    'slug' => $request->title,
                    'class' => $request->class,
                    'matiere' => $request->matiere,
                    'user_id' => auth()->id(),
                    'lesson' => $request->lesson,
                    'betreuung_id' => $b->id,
                    'betreuung' => $b->secret,
                    'description' => $request->description,
                    'body' => $request->body,
                ]);

        return redirect($course->path())->with('flash', 'Your Course has been created');
    }

    protected function getCourses(Betreuung $betreuung, CourseFilters $filters)
    {

        $courses = Course::with('klasse')->latest()->filter($filters);

        if ($betreuung->exists) {
            $courses->where('channel_id', $betreuung->id);
        }

        return $courses->paginate(10);
    }

    public function update($klass, Course $course)
    {

        $this->authorize('update', $course);

        request()->validate(
            [
                'title' => 'required|spamFree',
                'body' => 'required|spamFree',
                'betreuung' => 'exists:betreuungs,secret',
            ]
        );

        $course->update([
            'title' => request('title'),
            'body' => request('body'),
            'betreuung' => request('betreuung'),
            'lesson' => request('lesson')
        ]);

        return $course;
    }

    public function destroy($betreuung, Course $course)
    {

        $this->authorize('delete', $course);

        $course->delete();

        if (request()->wantsJson()) {
            return response([], 200);
        }

        return redirect('/courses');
    }

}
