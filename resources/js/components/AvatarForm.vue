<template>

    <div>
        <form v-if="canUpdate">
            <image-upload name="avatar" class="mr-2"
            @loaded="onLoad"
            ></image-upload>
            <button type="submit" class="btn btn-primary btn-sm">save</button>
        </form>
        <div>
            <img :src="avatar" width="200" alt="user.name">
        </div>
    </div>
</template>

<script>
    import ImageUpload from "./ImageUpload";

    export default {

        components: {
            ImageUpload,
        },

        props: ['user'],

        data() {
            return {
                avatar: this.user.avatar,
            }
        },

        computed: {
            canUpdate() {
                return this.authorize(user => user.id === this.user.id)
            },
        },

        methods: {
            onLoad(avatar) {

                this.avatar = avatar.src;

                //  Persist to server
                this.persist(avatar.file)
            },

            persist(avatar) {
                let data = new FormData();

                data.append('avatar', avatar);

                axios.post(`/users/${this.user.id}/avatar`, data)
                    .then(() => flash('Avatar Uploaded'));

            }
        },

    }
</script>
