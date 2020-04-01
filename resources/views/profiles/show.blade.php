@extends('layouts.app')

@section('content')

    {{--  New  --}}
    <div class="container mx-auto mt-10">

        <div class="flex justify-center flex-wrap">
            <div class="lg:w-3/5 pr-6">

                    {{--       Classes         --}}
                @if($user->klasses)
                    <div class="mb-3">
                        <table class="border-collapse border-2 w-100 border-gray-500">
                            <thead>
                            <tr class="font-small">
                                <th class="border border-gray-400 px-4 py-2 text-gray-800">Class</th>
                                @can('show', $user)<th class="border border-gray-400 px-4 py-2 text-gray-800">secret</th>@endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user->klasses as $betreu)
                                <tr>
                                    <td class="border border-gray-400 px-4 py-2"><a href="/klasse/{{$betreu->slug}}">{{$betreu->title}}</a></td>
                                    @can('show', $user)<td class="border border-gray-400 px-4 py-2">{{$betreu->secret}}</td>@endcan
                                </tr>
                            @endforeach
                            <tbody>
                        </table>
                    </div>
                @endif

                {{--        Thread        --}}
                @if($user->threads)
                    <div class="mb-3">
                        <table class="border-collapse border-2 w-100 border-gray-500">
                            <thead>
                            <tr>
                                <th class="border border-gray-400 px-4 py-2 text-gray-800 font-small">Threads</th>
{{--                                @can('show', $user)<th class="border border-gray-400 px-4 py-2 text-gray-800">secret</th>@endcan--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user->threads as $thread)
                                <tr>
                                    <td class="border border-gray-400 px-4 py-2 font-body"><a href="{{$thread->path()}}">{{$thread->title}}</a></td>
{{--                                    @can('show', $user)<td class="border border-gray-400 px-4 py-2">{{$betreu->secret}}</td>@endcan--}}
                                </tr>
                            @endforeach
                            <tbody>
                        </table>
                    </div>
                @endif

                {{--        Course        --}}
                @if($user->courses)
                    <div class="mb-3">
                        <table class="border-collapse border-2 w-100 border-gray-500">
                            <thead>
                            <tr>
                                <th class="border border-gray-400 px-4 py-2 text-gray-800 font-small">Courses</th>
{{--                                @can('show', $user)<th class="border border-gray-400 px-4 py-2 text-gray-800">secret</th>@endcan--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user->courses as $course)
                                <tr class="font-body">
                                    <td class="border border-gray-400 px-4 py-2 "><a href="{{$course->path()}}">{{$course->title}}</a></td>
{{--                                    @can('show', $user)<td class="border border-gray-400 px-4 py-2">{{$betreu->secret}}</td>@endcan--}}
                                </tr>
                            @endforeach
                            <tr>
                                <td class="border border-gray-400 px-4 py-2 text-xl font-semibold font-small underline"><a href="/courses/create">Create a new course</a></td>
                            </tr>
                            <tbody>
                        </table>
                    </div>
                @endif

                {{--      Activities       --}}
{{--                @foreach($activities as $date => $activity)--}}

{{--                    <h3> {{ $date }} </h3>--}}

{{--                    @foreach($activity as $record)--}}
{{--                        @if(view()->exists("profiles.activities.$record->type"))--}}

{{--                            @include("profiles.activities.$record->type", ['activity' => $record])--}}

{{--                        @endif--}}
{{--                    @endforeach--}}
{{--                @endforeach--}}

            </div>

            <div class="lg:w-2/5 pl-6">

                <avatar-form :user="{{$user}}"></avatar-form>

                @can('show', $user)
                    <div class="p-3 mt-3 border rounded-lg">
                        <h3 class="text-xl mb-4">Create a new classe</h3>
                        <form action="/klasse" method="post">
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                    Name
                                </label>
                                <input name="title" class=" appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="name" placeholder="Name">
                                @error('title')
                                    <p class="text-red-500 text-xs italic">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                    Description
                                </label>

                                <textarea rows="3" name="description" placeholder="Leave a comment..." class="w-full focus:bg-white focus:text-gray-900 rounded-lg p-3 bg-gray-200"></textarea>
                                @error('title')
                                <p class="text-red-500 text-xs italic">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>

                            @csrf
                            <button class="bg-blue-500 hover:bg-blue-700
                                text-right text-white font-bold
                            py-1 px-3 rounded-full" type="submit">Create</button>
                        </form>
                    </div>
                @endcan
            </div>
        </div>

    </div>
@endsection
