@extends('layouts.app')

@section('content')

    <class-view  :classe="{{$klass}}" inline-template>

        <div class="mx-auto mt-10">

            <div class="md:flex lg:flex xl:flex lg:justify-center xl:justify-center md:justify-center px-2">

                <div class="lg:w-3/5 md:w-2/3 lg:pl-6 lg:pr-3 md:px-1">
                    {{--        First section        --}}
                    <div class="rounded-lg shadow-md mb-4">
                        <div class="p-6">
                            {{--        Oriiginal              --}}
                            <div v-if="!editing">
                                <h3 class="text-2xl tracking-wide mb-4 text-gray-900 font-display" v-text="title"></h3>
                                <p class="tracking-wider  text-gray-600 font-body" v-text="description"></p>

                            </div>
                            {{--        Update Class        --}}
                            <div class="mt-3 rounded-lg" v-else>
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                        Name
                                    </label>
                                    <input  class=" appearance-none border rounded w-full
                                    py-2 px-3 text-gray-700
                                    leading-tight focus:outline-none focus:shadow-outline"
                                           id="username" type="text" placeholder="Name" v-model="title">
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                        Description
                                    </label>

                                    <textarea rows="3" name="description" placeholder="Leave a comment..."
                                              class="w-full focus:bg-white
                                    focus:text-gray-900
                                    rounded-lg p-3 bg-gray-200" v-model="description">

                                    </textarea>
                                </div>

                                <button class="bg-blue-500 hover:bg-blue-700 text-right text-white font-bold py-1 px-3 rounded-full" @click.prevent="update">Update</button>

                                <button class="bg-blue-200 mx-3 hover:bg-blue-300 text-blue-800 font-bold py-1 px-3 rounded inline-flex items-center" @click="cancel">
                                    {{--                                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/></svg>--}}
                                    <span>Cancel</span>
                                </button>
                            </div>

                            {{--        Created_by           --}}
                            <div class="flex items-center justify-between mt-3 font-bold">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mr-3 rounded-full border text-gray-700" viewBox="0 0 20 20"><path d="M5 5a5 5 0 0110 0v2A5 5 0 015 7V5zM0 16.68A19.9 19.9 0 0110 14c3.64 0 7.06.97 10 2.68V20H0v-3.32z"/></svg>
                                    <div class="text-sm">
                                        <p class="text-gray-900 leading-none font-bold"><a href="/@ {{$klass->user->name}}">{{$klass->user->name}}</a></p>
                                        <p class="text-gray-600">{{$klass->created_at->diffForHumans()}}</p>
                                    </div>
                                </div>

                                <div class="flex items-center text-gray-700 lg:text-xl text-sm">
                                    <div class="flex text-sm items-baseline  mr-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="lg:w-6 lg:h-6 mr-2 w-4 h-4" viewBox="0 0 20 20">
                                            <path d="M7 8a4 4 0 110-8 4 4 0 010 8zm0 1c2.15 0 4.2.4 6.1 1.09L12 16h-1.25L10 20H4l-.75-4H2L.9 10.09A17.93 17.93 0 017 9zm8.31.17c1.32.18 2.59.48 3.8.92L18 16h-1.25L16 20h-3.96l.37-2h1.25l1.65-8.83zM13 0a4 4 0 11-1.33 7.76 5.96 5.96 0 000-7.52C12.1.1 12.53 0 13 0z"/>
                                        </svg>
                                        <span class="lg:text-2xl text-sm" v-text="subscribes">
                                        </span>
                                    </div>
                                    <div class="flex items-baseline mr-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="lg:w-6 lg:h-6 mr-2 w-4 h-4" viewBox="0 0 20 20">
                                            <path d="M17 11v3l-3-3H8a2 2 0 01-2-2V2c0-1.1.9-2 2-2h10a2 2 0 012 2v7a2 2 0 01-2 2h-1zm-3 2v2a2 2 0 01-2 2H6l-3 3v-3H2a2 2 0 01-2-2V8c0-1.1.9-2 2-2h2v3a4 4 0 004 4h6z"/>
                                        </svg>
                                        <p class="lg:text-2xl text-sm" v-text="classe.courses_count">
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="bg-gray-100 flex p-3">
                            @can('destroy', $klass)
                                <form action="/klasse/{{$klass->slug}}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <button class="bg-red-200 mr-3 hover:bg-red-300 text-red-800 font-bold py-1 px-3 rounded inline-flex items-center">
                                        <span>Delete</span>
                                    </button>
                                </form>

                                <button class="bg-blue-200 mx-3 hover:bg-blue-300 text-blue-800 font-bold py-1 px-3 rounded inline-flex items-center" @click.prevent="editing = true">
                                    {{--                                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/></svg>--}}
                                    <span>Edit</span>
                                </button>
                            @endcan
                            <subscribe-class @subscribe="subscribes++" @unsubscribe="subscribes--" :active="{{json_encode($klass->isSubscribed)}}"></subscribe-class>
                        </div>

                    </div>

                    <?php $courses = $klass->courses()->paginate(10) ?>
                    @foreach($courses as $course)
                        @include('courses.list')
                    @endforeach

                    <div class="flex justify-center my-3">
                        {{ $courses->links() }}
                    </div>
                </div>

                <div class="lg:w-2/5 md:w-1/3 lg:pr-6 lg:pl-3 md:px-1">
                    {{--      Second section       --}}

                    {{--   Event  --}}
                    <div class=" rounded-lg border mb-6">
                        <h3 class="text-2xl px-3 pt-3 font-display tracking-wide text-gray-900 mr-2">Coming soon</h3>
                        @foreach($klass->events as $event)
                            @if($event->date > now())
                                <div class="p-3">
                                    <p class="tracking-wider sm:text-sm  text-gray-600 font-body">
                                        {{$event->description}}
                                    </p>
                                    <p class="text-gray-600 text-sm font-small font-semibold mt-2"> {{ $event->date->diffForHumans() }} </p>
                                </div>
                                <hr>
                            @endif
                        @endforeach

                        @can('create', $klass)
                            <div class="p-6 bg-gray-100">
                                <h3 class="text-xl font-display tracking-wide text-gray-900 mb-3">Create event</h3>
                                <form action="/events" method="post">
                                    @csrf
                                    <input type="hidden" name="betreuung_id" value="{{$klass->id}}">
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                            Description
                                        </label>
                                        <textarea name="description"
                                               class=" appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                               id="username"
                                               type="text"
                                               value="{{old('description')}}"
                                                  placeholder="What's up ?">
                                        </textarea>
                                        @error('description')
                                        <p class="text-red-500 text-xs italic">
                                            {{$message}}
                                        </p>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                            When ?
                                        </label>
                                        <input name="date"
                                               class=" appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                               id="username"
                                               type="date"
                                               value="{{old('date')}}"
                                               placeholder="when ?">
                                        @error('date')
                                        <p class="text-red-500 text-xs italic">
                                            {{$message}}
                                        </p>
                                        @enderror
                                    </div>

                                    <button type="submit"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded focus:outline-none focus:shadow-outline">
                                        Log In
                                    </button>
                                </form>
                            </div>
                        @endcan
                    </div>

                    <div class="rounded-lg border">
                        <div class="flex items-baseline px-3 py-3">
                            <h3 class="text-2xl font-display tracking-wide text-gray-900 mr-2">Popular Class</h3>
                            <p class="font-small text-gray-600 text-sm"><a href="/klasse">See all</a></p>
                        </div>

                        <div class="bg-gray-100 p-3">

                            @foreach(\App\Models\Betreuung::orderBy('courses_count', 'desc')->take(5)->get() as $klasse)
                                @include('klasse.list')
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </class-view>

@endsection
