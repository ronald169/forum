@extends('layouts.app')

@section('content')
    <div class="lg:px-10 mx-auto  mt-10">
        <div class="lg:flex md:flex lg:justify-center md:px-1 sm:px-1 md:justify-between">

            <div class="lg:w-3/5 px-2 md:w-2/3 lg:pr-4 md:px-1">
                @foreach($courses as $course)
                    @include('courses.list')
                @endforeach

                    <div class="flex my-6 justify-center">
                        {{ $courses->links() }}
                    </div>
            </div>


            {{--     Betreuung       --}}
            <div class="lg:w-2/5 md:w-1/3">
                <div class="rounded-lg border">
                    <div class="flex items-baseline px-3 py-3">
                        <h3 class="text-xl font-semibold text-gray-900 mr-2">Classes</h3>
                        <p class="text-gray-600 text-sm"><a href="/klasse">See all</a></p>
                    </div>

                    <div class="bg-gray-100 p-3 ">

                        @foreach($klasses as $klasse)
                            @include('klasse.list')
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

