<?php


namespace App\Filters;


use App\User;

class CommunityLinkFilter extends Filters
{
    protected $filters = ['by', 'popular'];

    public function by($user_name)
    {
        $user = User::where('name', $user_name)->firstOrFail();

        return $this->builder->where('user_id', $user->id);

    }

    public function popular()
    {
        $this->builder->getQUery()->orders = [];

        return $this->builder->orderBy('favorites_count', 'desc');
    }
}
