<template>

<div>
    <!--   Create a new comment     -->

    <div class="rounded-lg py-6 " v-if="signedIn">
        <h3 class="mb-4 text-gray-900 text-xl text-left">Add a new comment</h3>

        <div class="flex items-start">
<!--            <img class="w-12 h-12 border rounded-full mr-2" :src="avatar" alt="Avatar of Jonathan Reinink">-->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mr-2 rounded-full border text-gray-700" viewBox="0 0 20 20">
                <path d="M5 5a5 5 0 0110 0v2A5 5 0 015 7V5zM0 16.68A19.9 19.9 0 0110 14c3.64 0 7.06.97 10 2.68V20H0v-3.32z"/>
            </svg>
            <textarea rows="3" v-model="body" placeholder="Leave a comment..." class="w-full focus:bg-white focus:text-gray-900 rounded-lg p-3 bg-gray-200"></textarea>
        </div>

        <div class="mt-2 flex justify-end">
            <button class="bg-blue-500 hover:bg-blue-700
            text-right text-white font-bold
            py-1 px-3
            rounded-full" @click.prevent="post">
                Post
            </button>
        </div>
    </div>

    <!--   Comment     -->
    <h3 class="text-2xl border-b-2 py-3 text-center">
        Comments
        <span class="text-3xl text-gray-900 border-b-2 font-semibold" v-text="comments.length"></span>
    </h3>

    <div class="py-3  bg-white  border-b-2" v-for="comment in comments">
            <div class="flex items-start">
<!--                <img :src="comment.avatar" class="w-12 h-12 border rounded-full mr-2" alt="Avatar">-->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mr-2 rounded-full border text-gray-700" viewBox="0 0 20 20">
                    <path d="M5 5a5 5 0 0110 0v2A5 5 0 015 7V5zM0 16.68A19.9 19.9 0 0110 14c3.64 0 7.06.97 10 2.68V20H0v-3.32z"/>
                </svg>
                <div class="flex flex-col">
                    <div class="mb-2 text-sm">
                        <p class="text-gray-900 leading-none">
                            <a :href="`/@ ${comment.creator}`" v-text="comment.creator"></a>
                        </p>
                        <p class="text-gray-600" v-text="comment.created_at_human"></p>
                    </div>
                    <p class="text-gray-700" v-text="comment.body"></p>
                    <div class="flex ">
                        <button class="px-3 mt-2 border mr-3 font-semibold border-gray-700 bg-blue-600 text-white rounded-full" v-if="signedIn" @click.prevent="toggleReply(comment.id)">
                            {{visible === comment.id ? 'cancel' : 'reply'}}
                        </button>
                        <button class="px-3 mt-2 border mr-3 font-semibold  bg-red-600 text-white rounded-full"
                                v-if="authorize('updateComment', comment)"
                                @click.prevent="destroy(comment.id)">
                            delete
                        </button>
                    </div>

                <!--      Create reply comment              -->
                    <div class="mt-2 w-full" v-show="visible === comment.id">
                        <textarea rows="3" v-model="body_reply" placeholder="Leave a reply..." class="w-full focus:bg-white focus:text-gray-900 rounded-lg p-3 bg-gray-200"></textarea>
                        <button class="bg-blue-500 hover:bg-blue-700
                                text-right text-white font-bold
                                py-1 px-3
                                rounded-full" @click.prevent="reply(comment.id)">
                            Reply
                        </button>
                    </div>
                </div>
            </div>

            <!--     Replies       -->
            <div class="flex items-start pt-3 ml-16" v-for="reply in comment.replies.data">

<!--                <img :src="reply.avatar" class="w-12 h-12 -ml-2 border rounded-full mr-2" alt="Avatar">-->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mr-2 rounded-full border text-gray-700" viewBox="0 0 20 20">
                    <path d="M5 5a5 5 0 0110 0v2A5 5 0 015 7V5zM0 16.68A19.9 19.9 0 0110 14c3.64 0 7.06.97 10 2.68V20H0v-3.32z"/>
                </svg>
                <div class="flex flex-col">
                    <div class="mb-2 text-sm">
                        <p class="text-gray-900 leading-none">
                            <a :href="`/@ ${reply.creator}`" v-text="reply.creator"></a>
                        </p>
                        <p class="text-gray-600" v-text="reply.created_at_human"></p>
                    </div>
                    <p class="text-gray-700" v-text="reply.body"></p>
                    <div class="mb-2">
                        <button class="px-3 text-sm py-1 mt-2 font-semibold rounded-full  text-red-800 rounded-md bg-gray-100"
                                v-if="authorize('updateComment', reply)"
                                @click.prevent="destroy(reply.id)">
                            delete
                        </button>
                    </div>
                </div>
            </div>

        </div>
</div>

</template>

<script>
    export default {

        data() {
            return {
                url: `${location.pathname}/comments`,
                body: '',
                body_reply: '',
                visible: null,
                comments: []
            }
        },

        props: [],

        methods: {
            toggleReply(id){
                this.body_reply = null;

                if (this.visible === id) {
                    this.visible = null;
                    return;
                }

                this.visible = id
            },

            destroy(id) {
                if (!confirm('Are you sure you want to delete this comment ?')) {
                    return;
                }

                axios.delete(`${this.url}/${id}`).then(e => this.delete(id));
            },

            delete(id) {
                this.comments.map((comment, index) => {
                    if (comment.id === id) {
                        this.comments.splice(index, 1);
                        return;
                    }

                    comment.replies.data.map((reply, reply_index) => {
                        if (reply.id === id) {
                            this.comments[index].replies.data.splice(reply_index, 1);
                            return;
                        }
                    })
                })
            },

            getComments() {
                axios.get(`${this.url}`)
                    .then(e => {
                        this.comments = e.data.data
                    });
            },

            post() {
                axios.post(`${this.url}`, {
                    body: this.body
                }).then(e => {
                    this.comments.unshift(e.data.data);
                    this.body = null;
                })
            },

            reply(id) {
                axios.post(`${this.url}`, {
                    body: this.body_reply,
                    reply_id: id,
                }).then(e => {
                    this.comments.map((comment, index) => {
                        if  (comment.id === id) {
                            this.comments[index].replies.data.push(e.data.data);
                            return;
                        }
                    });

                    this.body = null;
                    this.visible = null;
                })
            }
        },

        created() {
            this.getComments();
        }
    }
</script>
