@extends('layouts.app')

@section('head')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection

@section('content')
    <div class="flex bg-gray-200  justify-center items-center min-h-screen">
        <div class="w-full max-w-3xl ">

            <form method="post" class="m-3 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="/threads">

                <h3 class="text-xl text-gray-900 mb-6 ">
                    {{ __('Create a new thread') }}
                </h3>

            <div class="form-group">
                @error('title')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="channel">Channel</label>

                <select name="channel_id" id="channel" class="form-control">
                    <option selected disabled>Select channel</option>
                    @foreach($channels as $channel)
                        <option value="{{ $channel->id }}" {{ @old('channel_id') == $channel->id ? 'selected' : '' }}>
                            {{ $channel->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" value="{{ old('title') }}">
            </div>

            <div class="form-group">
                <label for="body">Body</label>
                <wysiwyg name="body"></wysiwyg>
            </div>

            <div class="g-recaptcha" data-sitekey="6LfiPeEUAAAAAOo3TY7TnaM50LwRrXxLB87quWhi"></div>

            @csrf
            <div class="form-group">
                <button type="submit" class="btn btn-outline-primary">Submit</button>
            </div>
        </form>

        </div>
    </div>
@endsection
