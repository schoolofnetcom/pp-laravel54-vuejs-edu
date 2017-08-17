import {Teacher} from '../../services/resources';

const state = {
    classInformations: [],
    classInformation: null
};

const mutations = {
    setClassInformations(state,classInformations){
        state.classInformations = classInformations;
    },
    setClassInformation(state, classInformation){
        state.classInformation = classInformation;
    }
};

const actions = {
    query(context){
        Teacher.classInformation.query()
            .then(response => {
                context.commit('setClassInformations',response.data);
            });
    },
    get(context, classInformationId){
        Teacher.classInformation.get({class_information: classInformationId})
            .then(response => {
                context.commit('setClassInformation',response.data);
            })
    }
};

export default {
    namespaced: true,
    state, mutations,actions
}