
require('./bootstrap');

window.Vue = require('vue');

let authorizations = require('./authorizations');

Vue.prototype.authorize = function(...params) {
    if (! window.App.signedIn) return false;

    if (typeof params[0] === 'string') {
        return authorizations[params[0]](params[1]);
    }
    return params[0](window.App.user);
};

Vue.prototype.signedIn = window.App.signedIn;
if (window.App.signedIn) {
    Vue.prototype.avatar = window.App.user.avatar;
}

window.events = new Vue();

window.flash = function (message, level = 'success') {
    window.events.$emit('flash', {message, level});
};


// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('flash', require('./components/Flash.vue').default);
Vue.component('paginator', require('./components/Paginator.vue').default);
Vue.component('avatar-form', require('./components/AvatarForm.vue').default);
Vue.component('user-notifications', require('./components/UserNotifications.vue').default);
Vue.component('wysiwyg', require('./components/Wysiwyg.vue').default);
// Vue.component('subscribe-class', require('./components/SubscribeClass.vue').default);
// Vue.component('comment', require('./components/Comment.vue').default);


Vue.component('new-course', require('./components/NewCourse.vue').default);
Vue.component('community-view', require('./components/CommunityLink.vue').default);
Vue.component('thread-view', require('./components/pages/Thread.vue').default);
Vue.component('course-view', require('./components/pages/Course.vue').default);
Vue.component('class-view', require('./components/pages/Class.vue').default);

const app = new Vue({
    el: '#app',
});
