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
                return ['btn', this.sub ? 'btn-primary' : 'btn-default'];
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
