@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-body">
                        <form action="/threads/search?" method="get" class="form-inline">
                            <div class="input-group-sm">
                                <input type="text" class="form-control" name="q">
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm ml-2" type="submit">Search</button>
                        </form>
                    </div>
                </div>
                @include('threads._list')

                <div class="d-flex justify-content-center">
                    {{ $threads->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection
