<template>
    <div>
        <template v-if="isAuth">
            <template v-if="isTeacher">
                <teacher-menu></teacher-menu>
            </template>
            <template v-else>
                <student-menu></student-menu>
            </template>
        </template>
        <router-view></router-view>
    </div>
</template>

<script type="text/javascript">
    import TeacherMenuComponent from './teacher/TeacherMenu.vue';
    import StudentMenuComponent from './student/StudentMenu.vue';
    import authMixin from '../mixins/auth.mixin';

    export default {
        components: {
            'teacher-menu': TeacherMenuComponent,
            'student-menu': StudentMenuComponent,
        },
        mixins: [authMixin]
    }
</script>