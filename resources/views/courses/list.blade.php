<div class="rounded-lg border-gray-500 lg:p-6 p-3 border mb-1">

    <h3 class="text-xl tracking-wide mb-4 text-gray-800 font-display tracking-wide"><a href="{{ $course->path() }}">{{$course->title}}</a></h3>
    <p class="tracking-wider sm:text-sm  text-gray-600 font-body">
        {{$course->description}}
    </p>

    <div class="mt-4 flex justify-between">
        <div class="flex items-center font-semibold font-small">
            <svg xmlns="http://www.w3.org/2000/svg" class="lg:w-10 lg:h-10 w-8 h-8 md:w-8 md:h-8 mr-3 rounded-full border text-gray-700" viewBox="0 0 20 20"><path d="M5 5a5 5 0 0110 0v2A5 5 0 015 7V5zM0 16.68A19.9 19.9 0 0110 14c3.64 0 7.06.97 10 2.68V20H0v-3.32z"/></svg>
            <div class="text-sm ">
                <p class="text-gray-900 leading-none font-bottom font-semibold"><a href="/@ {{$course->user->name}}">{{$course->user->name}}</a></p>
                <p class="text-gray-600 ">{{$course->created_at->diffForHumans()}}</p>
            </div>
        </div>

        <div class="flex items-center">

            <div class="flex text-sm items-baseline mr-10 sm:mr-6 text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="lg:w-6 lg:h-6 mr-2 md:w-4 md:h-4 w-4 h-4" viewBox="0 0 20 20">
                    <path d="M11 0h1v3l3 7v8a2 2 0 01-2 2H5c-1.1 0-2.31-.84-2.7-1.88L0 12v-2a2 2 0 012-2h7V2a2 2 0 012-2zm6 10h3v10h-3V10z"/>
                </svg>
                <span class="lg:text-2xl md:text-lg text-lg">
                    {{ $course->favorites_count }}
                </span>
            </div>
            <div class="flex text-gray-700 text-sm items-baseline mr-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="lg:w-6 lg:h-6 mr-2 md:w-4 md:h-4 w-4 h-4" viewBox="0 0 20 20">
                    <path d="M17 11v3l-3-3H8a2 2 0 01-2-2V2c0-1.1.9-2 2-2h10a2 2 0 012 2v7a2 2 0 01-2 2h-1zm-3 2v2a2 2 0 01-2 2H6l-3 3v-3H2a2 2 0 01-2-2V8c0-1.1.9-2 2-2h2v3a4 4 0 004 4h6z"/>
                </svg>
                <span class="lg:text-2xl md:text-lg text-lg">
                    {{ $course->comments_count }}
                </span>
            </div>

        </div>

    </div>

</div>
