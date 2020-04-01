<template>
    <div class="inline-flex" v-if="shouldPaginate">
        <button class="bg-gray-300 hover:bg-gray-400
        text-gray-800 font-bold
        py-2 px-4 rounded-l" v-show="prevUrl" @click.prevent="page--">
            Prev
        </button>

        <button v-show="nextUrl" class="bg-gray-300 hover:bg-gray-400
        text-gray-800 font-bold
        py-2 px-4 rounded-r" @click.prevent="page++">
            Next
        </button>
    </div>
</template>

<script>
    export default {

        props: ['dataSet'],

        data() {
            return {
                page: 1,
                prevUrl: false,
                nextUrl: false
            }
        },

        watch: {
            dataSet() {
                this.page = this.dataSet.current_page;
                this.prevUrl = this.dataSet.prev_page_url;
                this.nextUrl = this.dataSet.next_page_url;
            },

            page() {
                this.broadcast().updateUrl();
            },
        },

        computed: {
            shouldPaginate() {
                return !! this.prevUrl || !! this.nextUrl;
            }
        },

        methods: {
            broadcast() {
                return this.$emit('changed', this.page);
            },

            updateUrl() {
                history.pushState(null, null, '?page=' + this.page)
            },
        },

    }
</script>
