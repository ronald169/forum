export default {

    data() {
        return {
            items: []
        }
    },

    methods: {
        remove(index) {
            this.items.splice(index, 1);

            this.$emit('remove');

            flash('Reply was deleted');
        },

        add(item) {
            this.items.push(item);
            this.$emit('added');
        },
    }
}
