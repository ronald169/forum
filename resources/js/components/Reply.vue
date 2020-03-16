<template>

        <div class="card mb-4" :id="`reply- ${reply.id}`">

            <div class="card-header justify-content-between d-flex " :class="isBest ? 'bg-success' : ''">
                <h5>
                    <a :href="`/@ ${reply.user.name}`" class="font-weight-bold" v-text="reply.user.name"></a> created
                    <span v-text="ago"></span>
                </h5>
                <div class="d-flex">

                    <favorite :reply="reply"></favorite>

                </div>

            </div>

            <div class="card-body">
                <div v-if="editing">

                    <form @submit="update">

                        <textarea name="body" class="form-control" v-model="body" rows="5" required>
                        </textarea>

                        <button class="btn btn-sm btn-primary mr-1"
                        @click.prevent="update"
                        v-if="authorize('updateReply', reply)"
                        type="submit">
                            update
                        </button>
                        <button class="btn btn-sm" @click="editing = false">cancel</button>

                    </form>

                </div>

                <div v-else v-html="body">
                </div>
            </div>


            <div class="card-footer d-flex"
                 v-if="authorize('owns', reply.thread) || authorize('owns', reply)">
                <div v-if="authorize('updateReply', reply)">
                    <button  @click.prevent="editing = true" class="btn btn-sm mr-1 btn-primary">Edit</button>
                    <button class="btn btn-danger btn-sm mr-1" @click.prevent="destroy" type="submit">delete</button>
                </div>
                <button v-if="authorize('owns', reply.thread)" class="btn btn-secondary btn-sm" v-show="!isBest" @click.prevent="markBestReply" type="submit">Best Reply</button>
            </div>

        </div>
<!--    </reply>-->
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

            destroy() {
                axios.delete(`/replies/${this.data.id}`);

                this.$emit('deleted', this.data.id);

                // $(this.$el).fadeOut(300, () => {
                //     flash('Your reply has been deleted.');
                // });
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
