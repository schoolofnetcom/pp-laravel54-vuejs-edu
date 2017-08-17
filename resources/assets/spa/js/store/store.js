import Vuex from 'vuex';
import auth from './auth';
import teacher from './teacher';

export default new Vuex.Store({
    modules: {
        auth, teacher
    }
});

