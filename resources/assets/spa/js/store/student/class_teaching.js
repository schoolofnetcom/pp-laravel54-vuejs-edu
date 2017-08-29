import {Student} from '../../services/resources';

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
    query(context,classInformationId){
        return Student.classTeaching.query({class_information: classInformationId})
            .then(response => {
                context.commit('setClassTeachings',response.data);
            });
    },
    get(context, {classInformationId, classTeachingId}){
        return Student.classTeaching.get({class_information: classInformationId,class_teaching: classTeachingId})
            .then(response => {
                context.commit('setClassTeaching',response.data);
            })
    }
};

export default {
    namespaced: true,
    state, mutations,actions
}