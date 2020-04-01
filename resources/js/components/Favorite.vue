<template>

    <button :class="classes" @click="toggle()" type="submit" :disabled="!signedIn">
        <img src="/zondicons/thumbs-up.svg" alt="favories" class="h-5 w-5 mr-2">
        <span v-text="favoritesCount " class="text-xl"></span>
    </button>

</template>

<script>
    export default {
        props: ['reply'],

        data() {
            return {
                favoritesCount: this.reply.favoritesCount,
                isFavorited: this.reply.isFavorited,
                endpoint: `/replies/${this.reply.id}/favorites`
            }
        },

        computed: {
            classes() {
                return ['font-bold flex items-baseline py-1 px-3 rounded-lg', this.isFavorited ? 'bg-green-200 text-green-900 hover:bg-gray-400' : 'bg-gray-300 text-green-900']
            }
        },

        methods: {
            toggle() {
                if (this.isFavorited) {
                    this.create()
                } else {
                    this.destroy()
                }
            },

            create() {
                axios.delete(`${this.endpoint}`);

                this.isFavorited = false;
                this.favoritesCount--
            },

            destroy() {
                axios.post(`${this.endpoint}`);

                this.isFavorited = true;
                this.favoritesCount++
            }
        }
    }
</script>
