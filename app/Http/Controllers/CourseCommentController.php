<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Course;
use App\Transformers\CommentTransformer;
use Illuminate\Http\Request;

class CourseCommentController extends Controller
{

    public function index($klass, Course $course)
    {
        return response()->json(
            fractal()->collection($course->comments()->latest()->get())
                    ->parseIncludes([
//                        'channel',
                        'replies',
//                        'replies.channel'
                    ])
                    ->transformWith(new CommentTransformer())
                    ->toArray()
        );
    }

    public function store(CommentRequest $request, $klass, Course $course)
    {
        $comment = $course->comments()->create([
            'body' => $request->body,
            'reply_id' => $request->get('reply_id', null),
            'user_id' => auth()->id(),
        ]);

        return response()->json(
            fractal()->item($comment)
                    ->parseIncludes(['replies'])
                    ->transformWith(new CommentTransformer())
                    ->toArray()
        );
    }

    public function destroy($klass, Course $course, Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return response()->json(null, 200);
    }

}
