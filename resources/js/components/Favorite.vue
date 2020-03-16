<template>

    <button :class="classes" @click="toggle()" type="submit" :disabled="!signedIn">
        like
        <span v-text="favoritesCount "></span>
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
                return ['btn', this.isFavorited ? 'btn-primary' : 'btn-default']
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
