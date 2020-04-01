<?php

namespace App\Http\Controllers;

use App\Models\Betreuung;
use Illuminate\Http\Request;

class ClassSubscriptionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Betreuung $klass)
    {

        $klass->subscribes()->create([
            'user_id' => auth()->id()
        ]);

        if (request()->wantsJson()) {
            return response([], 200);
        }

        return back();
    }

    public function destroy(Betreuung $klass)
    {
        $klass->unSubscribe();

        if (request()->wantsJson()) {
            return response([], 200);
        }

        return back();
    }


}
