<template>
    <!--        New-->
    <div class="rounded-lg mb-3" :id="`reply- ${reply.id}`" :class="isBest ? 'border-t-4  border-1 shadow-sm border-green-700' : 'border'">
        <div v-if="editing" class="p-6">
            <form @submit="update">
                <wysiwyg name="body" :value="body" v-model="body"></wysiwyg>

                <div class="mt-2">
                    <button class="btn btn-sm btn-primary mr-1"
                            @click.prevent="update"
                            v-if="authorize('updateReply', reply)"
                            type="submit">
                        update
                    </button>
                    <button class="btn btn-sm" @click="cancel">cancel</button>
                </div>
            </form>
        </div>
        <div v-else class="tracking-wide text-gray-600 p-6 font-body " v-html="body"></div>

        <div class="flex items-center px-6 justify-between" v-show="!editing" :class="isBest ? 'bg-green-200' : 'bg-gray-100'">
            <div class="flex items-center py-3 font-small font-semibold">
                <img class="w-10 h-10 rounded-full mr-3 border" :src="reply.user.avatar" alt="Avatar">
                <div class="text-sm">
                    <p class="text-gray-900 leading-none"><a :href="`/@ ${reply.user.name}`" v-text="reply.user.name"></a></p>
                    <p class="text-gray-600" v-text="ago"></p>
                </div>
            </div>
            <!--     Button           -->
            <div class="flex"
                 v-if="authorize('owns', reply.thread) || authorize('owns', reply)">
                <div v-if="authorize('updateReply', reply)">
                    <button  @click.prevent="editing = true" class="btn btn-sm mr-1 btn-primary">Edit</button>
                    <button class="btn btn-danger btn-sm mr-1" @click.prevent="destroy" type="submit">delete</button>
                </div>
                <button v-if="authorize('owns', reply.thread)" class="font-bold flex items-baseline py-1 px-3 rounded-lg text-green-900 bg-gray-200" v-show="!isBest" @click.prevent="markBestReply" type="submit">Best Reply</button>
            </div>

            <favorite :reply="reply"></favorite>
        </div>

    </div>
</template>


<script>

    import Favorite from './Favorite.vue';
    import moment from 'moment';

    export default {
        components: {
            Favorite,
        },
        props: ['data'],
        data() {
            return {
                editing: false,
                body: this.data.body,
                reply: this.data,
                created_at: this.data.created_at,
                isBest: this.data.isBest,
            }
        },

        computed: {

            ago() {
               return moment(this.created_at).fromNow();
            },

        },

        created() {

            window.events.$on('best-reply-selected', id => {
                this.isBest = (id === this.id)
            });

        },

        methods: {
            update() {
                axios.put(`/replies/${this.data.id}`, {
                    body: this.body
                }).then(({data}) =>  {
                    this.body = data.body;
                    this.editing = false;
                    flash('Updated!');
                })
                .catch(e => {
                    flash(e.response.data, 'danger');
                });
            },

            cancel() {
                this.body = this.data.body;
                this.editing = false
            },

            destroy() {
                if (confirm("Are you sure you want to delete ?")) {

                    axios.delete(`/replies/${this.data.id}`);

                    this.$emit('deleted', this.data.id);
                }

            },

            markBestReply() {
                axios.post(`/replies/${this.reply.id}/best`, {})
                    .then(() => {

                        window.events.$emit('best-reply-selected', this.data.id);
                        this.isBest = true;
                        flash('Your thread was ansawed!')

                    });
            }

        }
    }
</script>
