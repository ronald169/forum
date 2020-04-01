@extends('layouts.app')

@section('content')
    <community-view inline-template>

        <div class="min-h-screen mt-10">

            <div class="lg:flex lg:justify-center md:flex ">

                <div class="lg:w-2/4 md:w-2/3 md:px-2 p-2 lg:pr-3">
                    <div class="rounded-lg border">

                        <div class="p-6">
                            <h3 class="mb-4 font-display lg:text-2xl text-xl">
                                <a href="/communities">Communities</a>
                                @if($channel)
                                    <span> -- {{ $channel->name }}</span>
                                @endif
                            </h3>

                            @foreach($links as $link)
                                <div class="flex items-baseline justify-between">
                                    <div class="flex items-baseline lg:text-lg text-sm">
                                        <a class="mr-3 px-3 py-1 rounded-full font-semibold font-small bg-gray-300 text-gray-700" href="{{$link->channel->path_link()}}">{{ $link->channel->name }}</a>
                                        <p class="font-body text-gray-600 py-1">
                                            <a href="{{$link->link}}" target="_blank">{{ $link->title }}</a>
                                        </p>
                                    </div>
                                    <favorite-link :link="{{$link}}"></favorite-link>
                                </div>


                                <hr class="my-3">
                            @endforeach()
                        </div>

                        <div class="flex justify-center font-body py-6 bg-gray-200">
                            {{ $links->links() }}
                        </div>

                    </div>
                </div>

                <div class="lg:w-1/4 md:w-1/3 md:px-2 p-2 lg:pl-3">
                    <div class="rounded-lg border p-6">
                        @include('communities.create')
                    </div>
                </div>

            </div>

        </div>

    </community-view>

@endsection

