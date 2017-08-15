<template>
    <div>
        <teacher-menu></teacher-menu>
        <router-view></router-view>
    </div>
</template>

<script type="text/javascript">
    import TeacherMenuComponent from './teacher/TeacherMenu.vue';
    export default {
        components: {
            'teacher-menu': TeacherMenuComponent
        }
    }
</script>