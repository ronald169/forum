<div class="">
    <div class="shadow-sm p-6" v-if="!editing">
        <div class="pb-6">
            <h3 class="text-2xl text-gray-800 mb-3 font-displa tracking-wide" v-text="thread.title"></h3>

            <div class="mt-10 tracking-wide text-gray-700 font-body" v-html="thread.body"></div>
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
                <wysiwyg name="body" value="body" v-model="body"></wysiwyg>
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
</div>

