@extends('layouts.app')

@section('head')
{{--    <script src="https://www.google.com/recaptcha/api.js" async defer></script>--}}
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.css" rel="stylesheet">
@endsection

@section('content')


    <new-course inline-template>

        <div class="lg:flex bg-gray-200   justify-center items-center min-h-screen">
            <div class="lg:w-3/4 mx-auto w-full mx-3">

                <form method="post" class="m-3 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="/courses">

                    <h3 class="text-xl text-gray-900 mb-6 ">
                        {{ __('Create a new course') }}
                    </h3>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                            Title
                        </label>
                        <input name="title" class=" appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                               id="username" type="text" placeholder="Enter the title" value="{{ old('title') }}">
                        @error('title')
                        <p class="text-red-500 text-xs italic">
                            {{$message}}
                        </p>
                        @enderror
                    </div>

                    {{--        sasd      --}}
                    <div class="flex -mx-4 mb-4">
                        <div class="w-full w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                                Matiere
                            </label>
                            <div class="relative">
                                <select name="matiere" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                                    <option selected disabled>Choose matiere</option>
                                    @foreach(['mathematique', 'physique', 'chimie',
                                            'histoire', 'geographie', 'ecm', 'anglais', 'francais', 'informatique',
                                            'phylosophie', 'svt', 'autre'] as $i)
                                        <option value="{{$i}}" {{ old('matiere') == $i ? 'selected' : '' }}>{{$i}}</option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                    </svg>
                                </div>
                            </div>
                            @error('matiere')
                            <p class="text-red-500 text-xs italic">
                                {{$message}}
                            </p>
                            @enderror
                        </div>

                        <div class="w-full w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                                Level
                            </label>
                            <div class="relative">
                                <select name="class" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                                    <option selected disabled>Choose level</option>
                                    @foreach(['6', '5', '4', '3', '2c', '2a', '2g', '1c', '1d', '1a', 'tc', 'td', 'ta', 'bacc+'] as $i)
                                        <option value="{{$i}}" {{ old('class') == $i  ? 'selected' : ''}}>{{$i}}</option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                    </svg>
                                </div>
                            </div>
                            @error('class')
                            <p class="text-red-500 text-xs italic">
                                {{$message}}
                            </p>
                            @enderror
                        </div>

                        <div class="w-full w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                                Chapter
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                   id="grid-city"
                                   type="number"
                                   name="lesson"
                                   placeholder="Chapter 0">
                            @error('class')
                            <p class="text-red-500 text-xs italic">
                                {{$message}}
                            </p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                            Secret class
                        </label>
                        <input name="betreuung" class=" appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                               id="username" type="text" placeholder="Enter the secret class" value="{{ old('betreuung') }}">
                        @error('betreuung')
                        <p class="text-red-500 text-xs italic">
                            {{$message}}
                        </p>
                        @enderror
                    </div>

                    <div class="w-full mb-4">
                        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                                <textarea name="description" class="w-full focus:bg-white focus:text-gray-900 rounded-lg p-3 bg-gray-200" id="" rows="3" placeholder="Enter a small description">
                                {{ old('description') }}
                        </textarea>
                        @error('description')
                            <p class="text-red-500 text-xs italic">
                                {{$message}}
                            </p>
                        @enderror
                    </div>

                    <div class="mb-4">

                        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Content of your course</label>

                        <summernote name="body"></summernote>
                        @error('body')
                        <p class="text-red-500 text-xs italic">
                            {{$message}}
                        </p>
                        @enderror
                    </div>

{{--                    <div class="g-recaptcha" data-sitekey="6LfiPeEUAAAAAOo3TY7TnaM50LwRrXxLB87quWhi"></div>--}}

                    @csrf
                    <div class="form-group mt-3">
                        <button type="submit" class="px-3 py-2 bg-blue-600 rounded-lg text-white">Create</button>
                    </div>
                </form>

            </div>
        </div>


    </new-course>
@endsection
