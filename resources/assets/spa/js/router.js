import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './router.map';
import AppComponent from './components/App.vue';
import store from './store/store';

const router = new VueRouter({
    routes
});

router.beforeEach((to, from, next) => {
    if (to.meta.auth && !store.state.auth.check) {
        return router.push({name: 'login'});
    }
    next();
});

router.beforeEach((to, from, next) => {
    if(store.state.auth.user){
        if(store.getters['auth/isTeacher'] && to.name.startsWith('student')){
            return router.push({name: 'teacher.class_teachings.list'});
        }
        if(store.getters['auth/isStudent'] && to.name.startsWith('teacher')){
            return router.push({name: 'student.class_informations.list'});
        }
    }
    next();
});

new Vue({
    store,
    router,
    el: '#app',
    components: {
        'app': AppComponent
    }
});

export default router;