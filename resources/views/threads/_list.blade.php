@foreach($threads as $thread)
    <div class="card mb-2">
        <div class="card-body">

            <div class="">

                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="">
                        <a href="{{$thread->path()}}">
                            @if(auth()->check() && $thread->hasUpdatesFor(auth()->user()))
                                <strong>
                                    {{ $thread->title }}
                                </strong>
                            @else
                                {{ $thread->title }}
                            @endif
                        </a>

                    </h3>

                    <span class="badge badge-primary">{{ $thread->replies_count }} Replies</span>
                </div>

                created by : <a class="mt-0 pt-0" href="/@ {{ $thread->user->name }}">
                    {{ $thread->user->name }}
                </a>
            </div>

            <hr>

            <p>{{ $thread->body }}</p>

            <div>
                <a href="{{$thread->path_channel()}}"
                   class="btn btn-outline-primary btn-sm"
                >
                    {{ $thread->channel->name }}
                </a>
            </div>

        </div>

        <div class="card-body">
            <span class="badge badge-primary badge-pill">
                {{ $thread->visits }} Visits
            </span>
        </div>
    </div>
@endforeach
