<script>

    import Replies from "../Replies.vue";
    import SubscribeButton from '../SubscriptionButton'

    export default {
        props: ['thread'],

        components: {
            Replies,
            SubscribeButton,
        },

        data() {
            return {
                repliesCount: this.thread.replies_count,
                locked: this.thread.locked,
                editing: false,
                title: this.thread.title,
                body: this.thread.body,
                url: location.pathname,
            }
        },

        methods: {
            toggleLock() {
                axios[this.locked ? 'delete' : 'post'](`/locked-threads/${this.thread.slug}`)

                this .locked = ! this.locked;
            },

            update() {
                axios.put(`${this.url}`, {
                    body: this.body,
                    title: this.title
                }).then(() => {
                    flash('Thread was updated');

                    this.editing = false
                }).catch(e => flash('Data invalid', 'danger'))
            },

            cancel() {
                this.title = this.thread.title;
                this.body = this.thread.body;
                this.editing = false
            }
        },

    }
</script>
