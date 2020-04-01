<template>
    <textarea :name="name" ref="summernote" v-model="body" id="summernote" ></textarea>
</template>

<script>
    import 'summernote'
    export default {
        props: ['name', 'value'],

        data() {
            return {
                body: this.value
            }
        },

        created() {
            $(document).ready(function() {
                $('#summernote').summernote({
                    height: 200,                 // set editor height
                    minHeight: null,             // set minimum height of editor
                    maxHeight: null,             // set maximum height of editor
                    focus: true,
                });
            });
        },

        mounted() {
            let config = {
                height: this.height
            };

            let vm = this;

            config.callbacks = {

                onInit: function () {
                    $(vm.$el).summernote("code", vm.model);
                },

                onChange: function () {
                    vm.$emit('change', $(vm.$el).summernote('code'));
                },

                onBlur: function () {
                    vm.$emit('change', $(vm.$el).summernote('code'));
                }
            };

            $(this.$el).summernote(config);
        }
    }
</script>
