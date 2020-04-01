<template>
    <div>
        <button :class="classes"  @click.prevent="subscribe"
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
                // )](location.pathname + '/subscriptions');
                // this.sub =! this.sub;

                // flash('Subscribe');

                // axios[(


                this.sub ? this.destroy() : this.create()
            },

            destroy() {
                axios.delete(location.pathname + '/subscriptions');
                this.sub =! this.sub;
                flash('Success unsubscribe');
                this.$emit('unsubscribe');
            },
            create() {
                axios.post(location.pathname + '/subscriptions');
                flash('Success subscribe');
                this.sub =! this.sub;
                this.$emit('subscribe');
            },
        }

    }
</script>
