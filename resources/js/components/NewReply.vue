<template>
    <div class="my-6">
        <div v-if="signedIn">
            <div class="flex flex-col justify-end">
                <div class="mb-2">

                    <h3 class="text-2xl text-gray-900 mb-3">Add a new reply</h3>
                    <wysiwyg name="body"
                             @ v-model="body"
                             placeholder="Have you samething to tell ?"
                             ref="trix"
                             :shouldClear="completed"
                    ></wysiwyg>
                </div>

                <div>
                    <button @click="addReply"
                            type="submit" class="px-3 py-2 bg-blue-600  text-white rounded-full">Create</button>
                </div>

            </div>
        </div>
        <div class="d-flex justify-content-center" v-else>
            <p class="text-center font-semibold font-small">
                Please <a href="/login" class="underline">Sign In</a> for contribute
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
                completed: false,
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

                        // document.querySelector('trix-editor').value = '';

                        this.completed = true;
                        flash('Your reply has been posted');

                        this.$refs.trix.$refs.trix.value = '';

                        this.$emit('created', data);
                    }).catch(e => {
                        flash(e.response.data, 'danger');
                })
            }
        }
    }
</script>
