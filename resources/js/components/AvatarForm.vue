<template>

    <div>
        <div class=" border rounded-lg">
<!--            <div class="mb-3 flex justify-center mx-auto" >-->
<!--                <img :src="avatar" class="h-32 w-32 shadow rounded-full" alt="Avatar">-->
<!--            </div>-->

            <div class="w-full bg-gray-100 p-3 tracking-wide overflow-auto">
                <p class="text-sm text-blue-600 font-semibold font-small mb-3">Info</p>
                <p class="text-xl font-small font-semibold text-gray-700 tracking-wide flex items-baseline mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="w-4 h-4 mr-3 ">
                        <path d="M5 5a5 5 0 0110 0v2A5 5 0 015 7V5zM0 16.68A19.9 19.9 0 0110 14c3.64 0 7.06.97 10 2.68V20H0v-3.32z"/>
                    </svg>
                    <span v-text="user.name"></span>
                </p>

                <p class="text-lg font-body text-blue-700  flex items-baseline mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="w-4 h-4 mr-3">
                        <path d="M3.33 8L10 12l10-6-10-6L0 6h10v2H3.33zM0 8v8l2-2.22V9.2L0 8zm10 12l-5-3-2-1.2v-6l7 4.2 7-4.2v6L10 20z"/>
                    </svg>
                    <span v-text="user.profile.fonction"></span>
                </p>
                <p class="text-gray-600 font-small font-semibold mb-2 flex items-baseline mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="w-4 h-4 mr-3">
                        <path d="M18 2a2 2 0 012 2v12a2 2 0 01-2 2H2a2 2 0 01-2-2V4c0-1.1.9-2 2-2h16zm-4.37 9.1L20 16v-2l-5.12-3.9L20 6V4l-10 8L0 4v2l5.12 4.1L0 14v2l6.37-4.9L10 14l3.63-2.9z"/>
                    </svg>
                    <span v-text="user.email"></span>
                </p>
                <p class="text-gray-600 text-sm  flex items-baseline mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="w-4 h-4 mr-3">
                        <path d="M20 18.35V19a1 1 0 01-1 1h-2A17 17 0 010 3V1a1 1 0 011-1h4a1 1 0 011 1v4c0 .56-.31 1.31-.7 1.7L3.16 8.84c1.52 3.6 4.4 6.48 8 8l2.12-2.12c.4-.4 1.15-.71 1.7-.71H19a1 1 0 01.99 1v3.35z"/>
                    </svg>
                    <span v-text="user.profile.phone"></span>
                </p>
            </div>


<!--            <form class="p-2 overflow-hidden" v-if="canUpdate">-->
<!--                <image-upload name="avatar" class="mr-2"-->
<!--                              @loaded="onLoad"-->
<!--                ></image-upload>-->
<!--                <button type="submit" class="btn mt-2 btn-primary btn-sm">save</button>-->
<!--            </form>-->

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
