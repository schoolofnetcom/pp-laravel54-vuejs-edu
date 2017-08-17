<template>
    <div>
        <template v-if="isAuth">
            <teacher-menu></teacher-menu>
        </template>
        <router-view></router-view>
    </div>
</template>

<script type="text/javascript">
    import TeacherMenuComponent from './teacher/TeacherMenu.vue';
    import authMixin from '../mixins/auth.mixin';

    export default {
        components: {
            'teacher-menu': TeacherMenuComponent
        },
        mixins: [authMixin]
    }
</script>