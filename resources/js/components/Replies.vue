<template>

    <div>
        <div v-for="(reply, index) in items" :key="reply.id">
            <reply :data="reply" @deleted="remove(index)"></reply>
        </div>

        <div class="flex justify-center mb-6">
            <paginator :dataSet="dataSet" @changed="fetch"></paginator>
        </div>

        <p v-if="$parent.locked" class="text-center h3">
            This thread has been locked. No more replies are allow.
        </p>
        <new-reply @created="add" v-else></new-reply>
    </div>

</template>

<script>
    import Reply from './Reply.vue'
    import NewReply from './NewReply.vue'
    import collection from "../mixins/collection";

    export default {

        mixins: [collection],

        components: {
            Reply,
            NewReply
        },

        data() {
            return {
                items: [],
                dataSet: false
            }
        },

        created() {
            this.fetch();
        },

        methods: {

            fetch(page) {
                axios.get(this.url(page))
                    .then(this.refresh)
            },

            url(page) {
                if (! page) {
                    let query = location.search.match(/page=(\d+)/);

                    page = query ? query[1] : 1
                }

                return `${location.pathname}/replies?page=${page}`
            },

            refresh({data}) {
                this.dataSet = data;
                this.items = data.data;

                window.scrollTo(0, 0);
            },


        }
    }
</script>
