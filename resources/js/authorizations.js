let user = window.App.user;

module.exports = {
    updateReply(reply) {
       return reply.user_id === user.id;
    },

    updateCourse(course) {
       return course.user_id === user.id;
    },

    updateComment(comment) {
       return comment.user_id === user.id;
    },
    //
    // updateThread (thread) {
    //     return thread.user_id === user.id
    // },

    owns (model, prop = 'user_id') {
        return model[prop] === user.id;
    },

    isAdmin() {
        return ['ronald', 'mell', 'Hosea Rempel'].includes(user.name);
    }
};
