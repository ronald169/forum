@component('profiles.activities.activity')

    @slot('heading')
        <a href="{{ $activity->subject->favorite->path() }}">
            {{ $user->name }} favorited a reply
        </a>

    @endslot

    @slot('body')
        {{ $activity->subject->favorite->body }}
    @endslot
@endcomponent
