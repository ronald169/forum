@extends('layouts.app')

@section('content')
    <main class="container mx-auto mt-10">
        <div class="md:flex lg:flex xl:flex lg:justify-center xl:justify-center md:justify-center">
            <div class="lg:w-3/5 xl:w-3/5 md:w-2/3 lg:px-4 xl:px-4 md:px-1 ">
                @include('threads._list')

                <div class="flex justify-center my-4">
                    {{ $threads->links() }}
                </div>
            </div>

            <div class="lg:w-1/5 xl:w-1/5 md:w-1/3 lg:px-4 xl:px-4 md:px-1 ">
                <div class="flex justify-center font- font-small">
                    <a href="/threads/create" class="block
                    bg-green-600 text-center
                    py-2 px-3 text-white
                     rounded-full
                    text-center shadow">Create Thread</a>
                </div>

                <div class="my-10 md:pl-3">
                    <h3 class="text-sm py-3 text-gray-900 text-uppercase tracking-wide font-small font-semibold border-t-2">Channel</h3>

                    <div class="font-semibold font-small sm:text-sm md:text-sm">
                        <a href="/threads" class="lg:block py-1
                    font-bold rounded-full bg-gray-200 px-3 text-md md:block sm:inline-block">
                            All
                        </a>
                        @foreach($channels as $channel)
                            <a href="/threads/{{$channel->slug}}" class="hover:bg-gray-200 hover:rounded-full font-light
                            lg:block md:my-2 lg:py-1 sm:py-1 md:py-1 hover:font-bold rounded-full px-3 sm:text-md lg:text-xl sm:inline-block md:block md:text-xl">
                                {{ $channel->name }}
                            </a>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </main>
@endsection
