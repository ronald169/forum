<script>
    import SubscribeClass from "../SubscribeClass.vue";

    export default {

        components:{
            SubscribeClass
        },
        props: ['classe'],
        data() {
            return {
                description: this.classe.description,
                title: this.classe.title,
                editing: false,
                subscribes: this.classe.subscribes_count,
                url: location.pathname
            }
        },

        methods: {
            update() {
                axios.put(`${this.url}`, {
                    title: this.title,
                    description: this.description
                }).then(e => {
                    this.editing = false;
                    flash('Your class has updated !');
                }).catch(e => {
                    flash('Verified your data', 'danger');
                })
            },

            cancel() {
                this.description = this.classe.description;
                this.title = this.classe.title;

                this.editing = false;
            }
        }
    }
</script>
