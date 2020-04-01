<?php

namespace App\Http\Controllers;

use App\Models\Betreuung;
use Illuminate\Http\Request;

class BetreuungController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'index']);
    }

    public function index()
    {

        $klasses = Betreuung::paginate(10);

        return view('klasse.index')
            ->with('klasses', $klasses);
    }

    public function show(Betreuung $klass)
    {
        return view('klasse.show')->with('klass', $klass);
    }

    public function destroy(Betreuung $klass)
    {
        $this->authorize('destroy', $klass);

        $klass->delete();

        if (request()->wantsJson()) {
            return response([], 200);
        }

        return redirect('/klasse');
    }

    public function store()
    {
        auth()->user()->klasses()->create([
            'description' => request()->description,
            'title' => request()->title,
            'slug' => request()->title,
            'secret' => uniqid('secret_', true)
        ]);

        return back();
    }

    public function update(Betreuung $klass)
    {
        $this->authorize('update', $klass);

        $klass->update([
            'description' => request()->description,
            'title' => request()->title
        ]);

        if (request()->wantsJson()) {
            return $klass;
        }

        return back();
    }
}
