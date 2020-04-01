<?php

namespace App\Transformers;

use App\Models\Betreuung;
use League\Fractal\TransformerAbstract;

class ChannelTransformer extends TransformerAbstract
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
//        'channel'
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Betreuung $betreuung)
    {
        return [
            'id' => $betreuung->id,
            'slug' => $betreuung->slug,
            'title' => $betreuung->title,
            'creator' => $betreuung->user->name,
        ];
    }
}
