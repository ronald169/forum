@extends('layouts.app')

@section('head')
    {{--    <script src="https://www.google.com/recaptcha/api.js" async defer></script>--}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.css" rel="stylesheet">
@endsection

@section('content')

    <course-view class="mt-10" inline-template :course="{{$course}}">

        <div class="lg:px-6 mx-auto">

            <div class="lg:flex md:flex lg:justify-center">

                {{-- Course --}}
                <div class="lg:w-3/4 lg:pr-3 flex-1">
                    @include('courses._course')
                </div>

                {{--      Info    --}}
                <div class="lg:w-2/5 lg:pl-3 ">
                    <div class="lg:rounded-lg shadow">
                        <div class="">
{{--                            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 rounded-full border text-gray-700" viewBox="0 0 20 20">--}}
{{--                                <path d="M5 5a5 5 0 0110 0v2A5 5 0 015 7V5zM0 16.68A19.9 19.9 0 0110 14c3.64 0 7.06.97 10 2.68V20H0v-3.32z"/>--}}
{{--                            </svg>--}}
                            <div class="p-6">
                                <p class="text-sm text-blue-600 font-semibold font-small mb-3">Info</p>
                                <p class="text-xl font-small font-semibold text-gray-700 tracking-wide flex items-baseline mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="w-4 h-4 mr-3 ">
                                        <path d="M5 5a5 5 0 0110 0v2A5 5 0 015 7V5zM0 16.68A19.9 19.9 0 0110 14c3.64 0 7.06.97 10 2.68V20H0v-3.32z"/>
                                    </svg>
                                    <span>
                                        <a href="/@ {{$course->user->name}}">
                                            {{$course->user->name}}
                                        </a>
                                    </span>
                                </p>

                                <p class="text-lg font-body text-blue-700  flex items-baseline mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="w-4 h-4 mr-3">
                                        <path d="M3.33 8L10 12l10-6-10-6L0 6h10v2H3.33zM0 8v8l2-2.22V9.2L0 8zm10 12l-5-3-2-1.2v-6l7 4.2 7-4.2v6L10 20z"/>
                                    </svg>
                                    <span class="mr-2">{{ $course->user->profile->fonction }} </span>
                                    <span class="text-blue-600 font-small text-sm">
                                        to {{ $course->user->profile->school }}
                                    </span>
                                </p>
                                <p class="text-gray-600 font-small font-semibold mb-2 flex items-baseline mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="w-4 h-4 mr-3">
                                        <path d="M18 2a2 2 0 012 2v12a2 2 0 01-2 2H2a2 2 0 01-2-2V4c0-1.1.9-2 2-2h16zm-4.37 9.1L20 16v-2l-5.12-3.9L20 6V4l-10 8L0 4v2l5.12 4.1L0 14v2l6.37-4.9L10 14l3.63-2.9z"/>
                                    </svg>
                                    <span>{{ $course->user->email }}</span>
                                </p>
                                <p class="text-gray-600 text-sm  flex items-baseline mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="w-4 h-4 mr-3">
                                        <path d="M20 18.35V19a1 1 0 01-1 1h-2A17 17 0 010 3V1a1 1 0 011-1h4a1 1 0 011 1v4c0 .56-.31 1.31-.7 1.7L3.16 8.84c1.52 3.6 4.4 6.48 8 8l2.12-2.12c.4-.4 1.15-.71 1.7-.71H19a1 1 0 01.99 1v3.35z"/>
                                    </svg>
                                    <span>{{ $course->user->profile->phone }}</span>
                                </p>

                                <p class="text-gray-600 text-sm  flex items-baseline mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="h-4 w-4 mr-3">
                                        <path d="M10 12a6 6 0 110-12 6 6 0 010 12zm0-3a3 3 0 100-6 3 3 0 000 6zm4 2.75V20l-4-4-4 4v-8.25a6.97 6.97 0 008 0z"/>
                                    </svg>
                                    <span>
                                        <span>Course from . </span><a class="text-blue-600 text-sm" href="{{ $course->klasse->path() }}">{{ $course->klasse->title }}</a>
                                    </span>
                                </p>
                            </div>

                            <hr>

                            <div class="px-6 pb-3 font-small font-semibold text-gray-600">
                                <table class="table-auto mb-3">
                                    <thead>
                                    <tr>
                                        <th class="px-4 py-2">Chapter</th>
                                        <th class="px-4 py-2">visits</th>
                                        <th class="px-4 py-2">Exercise</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="border px-4 py-2">{{$course->lesson}}</td>
                                        <td class="border px-4 py-2">{{$course->visits}}</td>
                                        <td class="border px-4 py-2">{{$course->exercises_count}}</td>
                                    </tr>
                                    </tbody>
                                </table>

                                <table>
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-2">Followers</th>
                                            <th class="px-4 py-2">Matiere</th>
                                            <th class="px-4 py-2">Classe</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="border px-4 py-2">{{$course->members_count}}</td>
                                        <td class="border px-4 py-2">{{$course->matiere}}</td>
                                        <td class="border px-4 py-2">{{$course->class}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            {{--          Bottom commande          --}}
                            <div class="px-6 py-2 bg-gray-100 flex">
                                <course-favorite :course="course" ></course-favorite>
                                @can('delete', $course)
                                    <button
                                        class="inline-block mx-3 bg-blue-500 hover:bg-blue-700 text-white px-3 py-1 text-sm font-bold rounded-full"
                                        v-if="authorize('updateCourse', course)" @click="editing = true">
                                        Edit
                                    </button>

                                    <form action="{{ $course->path() }}" method="post">
                                        @csrf
                                        @method('DELETE')

                                        <button class="inline-block bg-red-500 text-white px-3 py-1 text-sm font-bold rounded-full" type="submit">Delete</button>
                                    </form>
                                @endcan
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </course-view>
@endsection
