<template>

    <div>
        <div class="card" v-if="signedIn">
            <div class="card-body">

                <div class="form-group">
                    <label >Reply</label>
                    <textarea type="text" id="body" rows="5" class="form-control" name="body"
                              v-model="body" placeholder="Say somethings"
                    >
                    </textarea>
                </div>

                <div class="form-group">
                    <button @click="addReply"
                            type="submit" class="btn btn-outline-primary">Submit</button>
                </div>

            </div>
        </div>
        <div class="d-flex justify-content-center" v-else>
            <p class="text-center">
                Please <a href="/login">Sign In</a> for contribute
            </p>
        </div>

    </div>

</template>

<script>
    import 'at.js';
    import 'jquery.caret';

    export default {
        data() {
            return {
                body: '',
                endpoint: location.pathname + '/replies',
            }
        },

        computed: {
            signedIn() {
                return window.App.signedIn;
            }
        },

        mounted() {
            $('#body').atwho({
                at: "@",
                delay: 750,
                callbacks: {
                    remoteFilter: function(query, callback) {
                        $.getJSON(`/users`, {name: query}, function (usernames) {
                            callback(usernames)
                        });
                    }
                }
            })
        },

        methods: {
            addReply() {
                axios.post(this.endpoint, {body: this.body})
                    .then(({data}) => {
                        this.body = '';

                        flash('Your reply has been posted');

                        this.$emit('created', data);

                    }).catch(e => {
                        flash(e.response.data, 'danger');
                })
            }
        }
    }
</script>
