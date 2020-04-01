@foreach($threads as $thread)

    <div class="rounded-md border mb-1">
        <div class="p-4 relative">
            <div class="flex justify-between items-baseline ">
                <h3 class="lg:text-2xl xl:text-2xl md:text-xl sm:text-lg truncate mb-3 tracking-wide text-gray-800 font-display">
                    <a href="{{$thread->path()}}">{{ $thread->title }}</a>
                </h3>
                <div class="flex lg:text-2xl xl:text-2xl md:text-xl sm:text-sm items-baseline text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="lg:w-5 lg:h-5 w-3 h-3 sm:w-4 sm:h-4 md:w-4 md:h-4 mr-2 " viewBox="0 0 20 20">
                        <path d="M17 11v3l-3-3H8a2 2 0 01-2-2V2c0-1.1.9-2 2-2h10a2 2 0 012 2v7a2 2 0 01-2 2h-1zm-3 2v2a2 2 0 01-2 2H6l-3 3v-3H2a2 2 0 01-2-2V8c0-1.1.9-2 2-2h2v3a4 4 0 004 4h6z"/>
                    </svg>
                    <span class="sm:text-md">
                        {{ $thread->replies_count }}
                    </span>
                </div>
            </div>
            <p class="text-sm text-gray-600 font-body tracking-wide mt-3">{!! $thread->body !!}</p>
            <div class="flex mt-4 items-center justify-between font-small font-semibold">

                <div class="flex items-center font-semibold font-small">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mr-3 rounded-full border text-gray-700" viewBox="0 0 20 20"><path d="M5 5a5 5 0 0110 0v2A5 5 0 015 7V5zM0 16.68A19.9 19.9 0 0110 14c3.64 0 7.06.97 10 2.68V20H0v-3.32z"/></svg>
                    <div class="text-sm">
                        <p class="text-gray-900 leading-none font-bottom font-bold"><a href="/@ {{$thread->user->name}}">{{$thread->user->name}}</a></p>
                        <p class="text-gray-600 ">{{$thread->created_at->diffForHumans()}}</p>
                    </div>
                </div>

                <div class="">
                    <a href="{{$thread->path_channel()}}" class="tag">
                        {{ $thread->channel->name }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endforeach
