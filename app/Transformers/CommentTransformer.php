<?php

namespace App\Transformers;

use App\Models\Comment;
use League\Fractal\TransformerAbstract;

class CommentTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
//        'channel',
        'replies'
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Comment $comment)
    {
        return [
            'id' => $comment->id,
            'user_id' => $comment->user_id,
            'avatar' => $comment->user->avatar,
            'creator' => $comment->user->name,
            'body' => $comment->body,
            'created_at' => $comment->created_at,
            'created_at_human' => $comment->created_at->diffForHumans(),
        ];
    }

//    public function includeChannel(Comment $comment)
//    {
//        return $this->item($comment->user->betreuung->first(), new ChannelTransformer());
//    }

    public function includeReplies(Comment $comment)
    {
        return $this->collection($comment->replies, new CommentTransformer());
    }
}
