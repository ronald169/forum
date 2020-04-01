@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen">

    <div class="shadow  text-center">
        <p class="p-6 text-6xl font-display">
            Thanks you for signIn :)
        </p>

        <div class="bg-gray-200 p-6">
            <p class="text-center font-body font-semibold text-2xl mb-6">Make your choice</p>
            <div class="font-body font-semibold">
                <p class="inline-block px-3 py-2 rounded-full text-gray-700 bg-gray-100"><a href="/threads">Forums</a></p>
                <p class="inline-block px-3 py-2 rounded-full text-gray-700 mx-3 bg-gray-100"><a href="/courses">Courses</a></p>
                <p class="inline-block px-3 py-2 rounded-full text-gray-700 bg-gray-100"><a href="/klasse">Classes</a></p>
            </div>
        </div>
    </div>

</div>
@endsection
