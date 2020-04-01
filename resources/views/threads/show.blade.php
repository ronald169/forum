@extends('layouts.app')

@section('content')
    <thread-view inline-template :thread="{{$thread}}" class="mt-10">

        <div class="mx-auto">
            <div class="lg:flex md:flex lg:justify-center md:justify-between sm:justify-between">
                <div class="lg:w-3/5  lg:pl-6 lg:pr-3 md:px-1 md:w-2/3">
                    <div class="mb-4">
                        @include('threads._question')
                    </div>

                    <div>
                        <replies @remove="repliesCount--"
                                 @added="repliesCount++" >
                        </replies>
                    </div>
                </div>

                <div class="lg:w-2/5 lg:pr-6 lg:pl-3 md:px-1 md:w-1/3">
                    <div class="">
                        <div class=" border rounded-lg">
                            <div class="p-6 tracking-wide">
                                <p class="text-gray-600">
                                    This thread was published {{ $thread->created_at->diffForHumans() }} by
                                    <a class="text-lg text-gray-800 font-small font-semibold underline " href="/@ {{ $thread->user->name }}">{{ $thread->user->name }}</a>, and currently
                                    has <span class="text-lg text-gray-800" v-text="repliesCount"></span>  comments.
                                </p>
                            </div>

                            <div class="flex bg-gray-100 p-3">
                                <subscribe-button class="mr-1" :active="{{json_encode($thread->isSubscribeTo)}}"></subscribe-button>
                                <button class="btn btn-secondary"
                                        v-if="authorize('isAdmin')"
                                        @click="toggleLock"
                                        v-text="locked ? 'Unlock' : 'Lock'"></button>
                                @can('delete', $thread)
                                    <div class="px-6 py-4">
                                        <button
                                            class="inline-block  bg-blue-500 hover:bg-blue-700 text-white px-3 py-1 text-sm font-bold rounded-full"
                                            @click="editing = true">
                                            Edit
                                        </button>

                                        <form action="{{ $thread->path() }}" method="post" class="inline-block">
                                            @csrf
                                            @method('DELETE')

                                            <button class="inline-block bg-red-500 hover:bg-red-700 text-white px-3 py-1 text-sm font-bold rounded-full" type="submit">delete</button>
                                        </form>
                                    </div>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </thread-view>
@endsection
