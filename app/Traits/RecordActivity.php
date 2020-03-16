<?php


namespace App\Traits;


use App\Models\Activity;
use App\Models\Thread;
use Illuminate\Database\Eloquent\Model;

trait RecordActivity
{

    protected static function bootRecordActivity()
    {

        if (auth()->guest()) return;

        foreach (static::getActivitiesToRecord() as $event) {
            static::$event(function ($model) use ($event) {
                $model->recordActivity($event);
            });
        }

        static::deleting(function ($model) {
            $model->activities()->delete();
        });
    }

    protected static function getActivitiesToRecord()
    {
        return ['created'];
    }

    public function activities()
    {
        return $this->morphMany('App\Models\Activity', 'subject');
    }

    protected function recordActivity($model)
    {
        $this->activities()->create([
            'user_id' => auth()->id(),
            'type' => $this->getActivityType($model),
        ]);
    }

    protected function getActivityType($event)
    {
        return $event.'_' . strtolower((new \ReflectionClass($this))->getShortName());
    }
}
