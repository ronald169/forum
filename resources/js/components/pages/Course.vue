<script>
    import CourseFavorite from "../CourseFavorite.vue";
    import Comment from "../Comment.vue";
    import Summernote from "../Summernote";

    export default {
        props: ['course'],

        data() {
            return {
                editing: false,
                title: this.course.title,
                lesson: Number(this.course.lesson),
                betreuung: this.course.betreuung,
                description: this.course.description,
                body: this.course.body,
                url: location.pathname
            }
        },

        components: {
            CourseFavorite,
            Comment,
            Summernote
        },

        methods: {
            update() {
                axios.put(`${this.url}`, {
                    title: this.title,
                    betreuung: this.betreuung,
                    description: this.description,
                    body: this.body,
                    lesson: Number(this.lesson),
                }).then(() => {
                    flash('Thread was updated');

                    this.editing = false
                }).catch(e => flash('Verified the secret class or other data', 'danger'))
            },

            cancel() {
                this.title = this.course.title;
                this.betreuung = this.course.betreuung;
                this.description = this.course.description;
                this.body = this.course.body;
                this.editing = false
            },

            change(e) {
                this.body = e
            }
        }
    }
</script>
