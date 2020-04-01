<div class="">
    <h3 class="tracking-wide mb-3 font-display lg:text-xl text-md text-gray-800"><a href="{{$klasse->path()}}">{{$klasse->title}}</a></h3>

    <div class="flex justify-between">
        <div class="flex items-center font-small font-semibold">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10  lg:mr-3 mr-1 rounded-full border text-gray-700" viewBox="0 0 20 20">
                <path d="M5 5a5 5 0 0110 0v2A5 5 0 015 7V5zM0 16.68A19.9 19.9 0 0110 14c3.64 0 7.06.97 10 2.68V20H0v-3.32z"/>
            </svg>

            <div class="text-sm">
                <p class="text-gray-900 leading-none"><a href="/@ {{$klasse->user->name}}">{{$klasse->user->name}}</a></p>
                <p class="text-gray-600">{{ $klasse->created_at->diffForHumans() }}</p>
            </div>
        </div>

        <div class="flex items-center text-gray-700 lg:text-xl text-sm">
            <div class="flex text-sm items-baseline  mr-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="lg:w-6 lg:h-6 mr-2 w-4 h-4" viewBox="0 0 20 20">
                    <path d="M7 8a4 4 0 110-8 4 4 0 010 8zm0 1c2.15 0 4.2.4 6.1 1.09L12 16h-1.25L10 20H4l-.75-4H2L.9 10.09A17.93 17.93 0 017 9zm8.31.17c1.32.18 2.59.48 3.8.92L18 16h-1.25L16 20h-3.96l.37-2h1.25l1.65-8.83zM13 0a4 4 0 11-1.33 7.76 5.96 5.96 0 000-7.52C12.1.1 12.53 0 13 0z"/>
                </svg>
                <span class="lg:text-2xl text-sm">
                    {{ $klasse->members_count }}
                </span>
            </div>
            <div class="flex items-baseline mr-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="lg:w-6 lg:h-6 mr-2 w-4 h-4" viewBox="0 0 20 20">
                    <path d="M17 11v3l-3-3H8a2 2 0 01-2-2V2c0-1.1.9-2 2-2h10a2 2 0 012 2v7a2 2 0 01-2 2h-1zm-3 2v2a2 2 0 01-2 2H6l-3 3v-3H2a2 2 0 01-2-2V8c0-1.1.9-2 2-2h2v3a4 4 0 004 4h6z"/>
                </svg>
                <p class="lg:text-2xl text-sm">
                    {{ $klasse->courses_count }}
                </p>
            </div>
        </div>
    </div>

    <hr class="my-3">
</div>
