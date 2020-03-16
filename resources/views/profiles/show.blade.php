@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <h3 class="text-center ">
                     <strong>{{ $user->name }}</strong> since {{ $user->created_at->diffForHumans() }}
                </h3>

                <avatar-form :user="{{$user}}"></avatar-form>

                <hr>

                {{-- Threads --}}
                @foreach($activities as $date => $activity)

                    <h3> {{ $date }} </h3>

                    @foreach($activity as $record)
                        @if(view()->exists("profiles.activities.$record->type"))

                            @include("profiles.activities.$record->type", ['activity' => $record])

                        @endif
                    @endforeach

                @endforeach


            </div>
        </div>
    </div>
@endsection
