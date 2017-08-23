import {Teacher} from '../../services/resources';

const state = {
    classTeachings: [],
    classTeaching: null
};

const mutations = {
    setClassTeachings(state,classTeachings){
        state.classTeachings = classTeachings;
    },
    setClassTeaching(state, classTeaching){
        state.classTeaching = classTeaching;
    }
};

const actions = {
    query(context){
        return Teacher.classTeaching.query()
            .then(response => {
                context.commit('setClassTeachings',response.data);
            });
    },
    get(context, classTeachingId){
        return Teacher.classTeaching.get({class_teaching: classTeachingId})
            .then(response => {
                context.commit('setClassTeaching',response.data);
            })
    }
};

export default {
    namespaced: true,
    state, mutations,actions
}