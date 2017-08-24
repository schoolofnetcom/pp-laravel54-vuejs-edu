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

new Vue({
    store,
    router,
    el: '#app',
    components: {
        'app': AppComponent
    }
});

export default router;