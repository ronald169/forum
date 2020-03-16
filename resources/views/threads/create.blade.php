@extends('layouts.app')

@section('head')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-body">

                        <form method="post" action="/threads">

                            <div class="form-group">
                                @error('title')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="channel">Channel</label>
                                <select name="channel_id" id="channel" class="form-control">
                                    <option value="">Select channel</option>
                                    @foreach($channels as $channel)
                                        <option value="{{ $channel->id }}"
                                                selected="{{ old('channel_id') == $channel->id }}">
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
                                <label for="body">Reply</label>
                                <textarea type="text" rows="5" class="form-control" name="body"
                                          placeholder="Say somethings"
                                          value="{{ old('body') }}"
                                >
                        </textarea>
                            </div>

                            <div class="g-recaptcha" data-sitekey="6LfiPeEUAAAAAOo3TY7TnaM50LwRrXxLB87quWhi"></div>

                            @csrf
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-primary">Submit</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection
