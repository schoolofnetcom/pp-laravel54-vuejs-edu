import Vuex from 'vuex';
import Vue from 'vue';
import auth from './auth';
import teacher from './teacher';
import student from './student';
import * as VueDeepSet from 'vue-deepset';

Vue.use(VueDeepSet);

export default new Vuex.Store({
    mutations: VueDeepSet.extendMutation(),
    modules: {
        auth, teacher, student
    }
});

