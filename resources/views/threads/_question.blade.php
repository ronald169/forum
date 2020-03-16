<div class="card mb-4" v-if="!editing">
    <div class="card-header d-flex justify-content-between">
        <h2 v-text="title">

        </h2>
        @can('delete', $thread)
            <form action="{{ $thread->path() }}" method="post">
                @csrf
                @method('DELETE')

                <button class="btn btn-sm btn-danger" type="submit">delete</button>
            </form>
        @endcan
    </div>

    <div class="card-body" v-text="body"></div>

    <div class="card-footer" v-if="authorize('owns', thread)">
        <button
            class="btn btn-primary btn-sm"
            @click="editing = true">
            Edit
        </button>
    </div>
</div>

<div class="card mb-4" v-else>
    <div class="card-header">
        <div class="form-group">
            <label>Title</label>
            <input type="text" class="form-control" v-model="title">
        </div>
    </div>

    <div class="card-body">

        <div class="form-group">
            <label>Body</label>
            <textarea class="form-control" rows="5" v-model="body"></textarea>
        </div>

    </div>

    <div class="card-footer">
        <button
            class="btn btn-primary btn-sm"
            @click="update">
            Update
        </button>
        <button
            class="btn btn-primary btn-sm"
            @click="cancel">
            Cancel
        </button>
    </div>
</div>

