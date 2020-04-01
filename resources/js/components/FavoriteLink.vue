<template>

    <button class="flex items-baseline" :class="classes" @click="toggle()" type="submit" :disabled="!signedIn">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="lg:w-5 lg:h-5 mr-2 md:w-4 md:h-4 w-4 h-4">
            <path d="M11 0h1v3l3 7v8a2 2 0 01-2 2H5c-1.1 0-2.31-.84-2.7-1.88L0 12v-2a2 2 0 012-2h7V2a2 2 0 012-2zm6 10h3v10h-3V10z"></path>
        </svg>
        <span v-text="favoritesCount " class="lg:text-xl text-sm"></span>
    </button>

</template>

<script>
    export default {
        props: ['link'],

        data() {
            return {
                favoritesCount: this.link.favoritesCount,
                isFavorited: this.link.isFavorited,
                endpoint: `/communities/${this.link.id}/favorites`
            }
        },

        computed: {
            classes() {
                return ['inline-block px-2 text-sm font-bold rounded-full', this.isFavorited ? 'bg-green-300  text-green-900' : 'bg-gray-300 text-gray-900']
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
