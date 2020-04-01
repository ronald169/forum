<form action="/communities" method="post">
    @csrf
    <div class="mb-4">
        <h3 class="mb-4 text-xl text-gray-800 font-display">Create link</h3>

        <select name="channel_id" class="form-control">
            <option selected disabled>Choose matiere</option>
            @foreach(\App\Models\Channel::get() as $c)
                <option value="{{$c->id}}"
                    {{ old('channel_id') == $c->id ? 'selected' : '' }}>{{$c->name}}</option>
            @endforeach
        </select>
        @error('channel_id')
        <p class="text-red-500 text-xs italic">
            {{$message}}
        </p>
        @enderror
    </div>

    <div class="mb-4">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                Title
            </label>
            <input name="title" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                   id="username"
                   type="mail"
                   placeholder="Username" value="{{ old('title') }}">
            @error('title')
            <p class="text-red-500 text-xs italic">
                {{$message}}
            </p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                Link
            </label>
            <input name="link" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                   id="username"
                   type="text"
                   placeholder="Username" value="{{ old('link') }}">
            @error('link')
            <p class="text-red-500 text-xs italic">
                {{$message}}
            </p>
            @enderror
        </div>

        <button type="submit" class="px-2 py-1 text-white bg-blue-600 rounded-full">Create</button>
    </div>
</form>
