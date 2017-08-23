

export default [
    /*{
        name: 'class_informations.list',
        path: '/classes',
        component: require('./components/teacher/TeacherClassInformationList.vue'),
        meta: {
            auth: true
        }
    },*/
    {
        name: 'class_teachings.list',
        path: '/classes',
        component: require('./components/teacher/TeacherClassTeachingList.vue'),
        meta: {
            auth: true
        }
    },
    {
        name: 'login',
        path: '/login',
        component: require('./components/Login.vue')
    },
    { path: '*', redirect: '/login' }
];