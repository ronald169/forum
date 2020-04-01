@extends('layouts.app')

@section('content')
<div class="flex bg-gray-200 justify-center items-center min-h-screen">

    <div class="w-full py-10 max-w-md">
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
              method="POST" action="{{ route('register') }}">

            @csrf

            <h3 class="text-xl text-gray-900 mb-6 font-semibold text-center">
                {{ __('Register') }}
            </h3>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    {{ __('Name') }}
                </label>
                <input name="name" required class=" appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Username">
                @error('name')
                <p class="text-red-500 text-xs italic">
                    {{$message}}
                </p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    {{ __('Email') }}
                </label>
                <input name="email" class=" appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" placeholder="Username" required>
                @error('email')
                <p class="text-red-500 text-xs italic">
                    {{$message}}
                </p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input name="password" class=" appearance-none border border-red-500 rounded w-full py-2 px-3
                        text-gray-700 mb-3
                        leading-tight focus:outline-none focus:shadow-outline"
                       id="password" type="password" placeholder="******************">

                @error('password')
                <p class="text-red-500 text-xs italic">
                    {{$message}}
                </p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    New password
                </label>
                <input name="password_confirmation" class=" appearance-none border border-red-500 rounded w-full py-2 px-3
                        text-gray-700 mb-3
                        leading-tight focus:outline-none focus:shadow-outline"
                       id="password_confirmation" type="password" placeholder="******************">

                @error('password_confirmation')
                <p class="text-red-500 text-xs italic">
                    {{$message}}
                </p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Sign In
                </button>
{{--                @if (Route::has('password.request'))--}}

{{--                    <a href="{{ route('password.request') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">--}}
{{--                        Forgot Password?--}}
{{--                    </a>--}}
{{--                @endif--}}
            </div>
        </form>
    </div>

</div>

@endsection
