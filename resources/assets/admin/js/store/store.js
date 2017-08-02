import Vuex from 'vuex';
import classStudent from './class_student';
import classTeaching from './class_teaching';

export default new Vuex.Store({
    modules: {
        classStudent, classTeaching
    }
});