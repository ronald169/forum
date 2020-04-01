    {{--        Course        --}}
    <div class="w-full p-6 shadow-sm lg:max-w-full lg:flex mb-3" v-if="!editing">
        <div class="">
            <h3 class="text-2xl text-gray-800 mb-3 font-display tracking-wide" v-text="title"></h3>

            <p class="text-lg font-small font-semibold text-gray-700 tracking-wide" v-html="description"></p>

            <div class="mt-10 tracking-wider leading-normal  text-gray-600 font-body" v-html="body"></div>
        </div>
    </div>

    <div class="p-3 bg-white" v-else>

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" v-model="title">
        </div>

        <div class="form-group">
            <label for="title">Class</label>
            <input type="text" placeholder="Please enter the secret class" class="form-control" name="betreuung" v-model="betreuung">
        </div>

        <div class="form-group">
            <label>lesson</label>
            <input type="number" placeholder="what chapter ?" class="form-control" name="betreuung" v-model="lesson">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" id="" rows="3" placeholder="Enter a small description" v-model="description">
            </textarea>
        </div>

        <div class="mb-3">
            <summernote name="body" @change="change" v-model="body" value="body"></summernote>
        </div>

{{--        <div class="g-recaptcha" data-sitekey="6LfiPeEUAAAAAOo3TY7TnaM50LwRrXxLB87quWhi"></div>--}}

        <button type="submit" class="btn btn-outline-primary" @click="update">Submit</button>

        <button type="submit" class="btn btn-outline-primary" @click="cancel">cancel</button>
    </div>


    {{--    Commentaire     --}}
    <comment class="my-3 mx-2 lg:mx-0"></comment>
