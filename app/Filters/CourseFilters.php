<?php


namespace App\Filters;


use App\User;

class CourseFilters extends Filters
{
    protected $filters = ['by', 'popular', 'unanswered'];

    public function by($user_name)
    {
        $user = User::where('name', $user_name)->firstOrFail();

        return $this->builder->where('user_id', $user->id);
    }

//    public function popular()
//    {
//        $this->builder->getQUery()->orders = [];
//
//        return $this->builder->orderBy('favorites_count', 'desc');
//    }

    protected function unanswered()
    {
        return $this->builder->where('replies_count', 0);
    }
}
