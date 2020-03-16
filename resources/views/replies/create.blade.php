
<div class="card">
    <div class="card-body">

        <form method="post" action="/threads/{{$thread->id}}/replies">
            <div class="form-group">
                <label for="body">Reply</label>
                <textarea type="text" rows="5" class="form-control" name="body"
                          placeholder="Say somethings"
                >
            </textarea>
            </div>

            @csrf
            <div class="form-group">
                <button type="submit" class="btn btn-outline-primary">Submit</button>
            </div>
        </form>

    </div>
</div>
