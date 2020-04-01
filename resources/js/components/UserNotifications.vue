<template>

    <li class="nav-item dropdown" v-if="notifications.length">

        <a id="navbarDropdown" class="nav-link " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20">
                <path d="M6 8v7h8V8a4 4 0 10-8 0zm2.03-5.67a2 2 0 113.95 0A6 6 0 0116 8v6l3 2v1H1v-1l3-2V8a6 6 0 014.03-5.67zM12 18a2 2 0 11-4 0h4z"/>
            </svg>
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

            <a :href="notification.data.link"
               class="dropdown-item"
               v-for="notification in notifications"
               :key="notification.id"
               v-text="notification.data.message"
               @click="markAsRead(notification)"
            ></a>
        </div>
    </li>

</template>

<script>
    export default {
        data() {
            return {
                notifications: [],
            }
        },

        created() {
            axios.get(`/profiles/${window.App.user.name}/notifications`)
            .then(
                response => this.notifications = response.data
            )
        },

        methods: {
            markAsRead(notification) {
                axios.delete(`/profiles/${window.App.user.name}/notifications/${notification.id}`)
            }
        }
    }
</script>
