<template>
    <div>
        <button :class="classes"  @click="subscribe"
        :disabled="!signedIn"
        >Subscribe</button>
    </div>
</template>

<script>
    export default {

        props: ['active'],

        data() {
            return {
                sub: this.active
            }
        },

        computed: {
            classes() {
                return ['font-bold py-1 px-3 rounded-lg', this.sub ? 'bg-green-200 text-green-900 hover:bg-gray-400' : 'bg-gray-300 text-green-900'];
            }
        },

        methods: {
            subscribe() {
                axios[(
                    this.sub ? 'delete' : 'post'
                )](location.pathname + '/subscriptions');

                this.sub =! this.sub;

                flash('Subscribe');
            }
        }

    }
</script>
