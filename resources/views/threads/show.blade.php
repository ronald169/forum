@extends('layouts.app')

@section('content')
    <thread-view inline-template :thread="{{$thread}}">

        <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @include('threads._question')
                {{--        Replies        --}}

                <div class="">

                    <replies @remove="repliesCount--"
                             @added="repliesCount++" >
                    </replies>

                </div>

            </div>

            {{--     Owne Thread      --}}
            <div class="col-md-4">

                <div class="card">

                    <div class="card-body">

                        <p>
                            This thread was published {{ $thread->created_at->diffForHumans() }} by
                            <a class="lead" href="/@ {{ $thread->user->name }}">{{ $thread->user->name }}</a>, and currently
                            has <span class="badge-pill badge-primary" v-text="repliesCount"></span>  comments.
                        </p>
                        <p class="d-flex">
                            <subscribe-button class="mr-1" :active="{{json_encode($thread->isSubscribeTo)}}"></subscribe-button>
                            <button class="btn btn-secondary"
                                    v-if="authorize('isAdmin')"
                                    @click="toggleLock"
                                    v-text="locked ? 'Unlock' : 'Lock'"></button>
                        </p>
                    </div>

                </div>

            </div>

        </div>
    </div>

    </thread-view>
@endsection
