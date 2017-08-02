import {ClassTeaching} from '../services/resources';
import Vue from 'vue';
import ADMIN_CONFIG from '../services/adminConfig';

const state = {
    teachings: []
};

const mutations = {
    add(state, student){
        state.teachings.push(student);
    },
    set(state,teachings){
        state.teachings = teachings;
    },
    destroy(state,teachingId){
        let index = state.teachings.findIndex((item) => {
            return item.id == teachingId;
        });
        if(index!=-1){
            state.teachings.splice(index,1);
        }
    }
};

const actions = {
    query(context,classInformationId){
        return Vue.http.get(`${ADMIN_CONFIG.ADMIN_URL}/class_informations/${classInformationId}/teachings`)
            .then(response => {
                context.commit('set',response.data);
            })
    },
    store(context, {teacherId,subjectId, classInformationId}){
        return ClassTeaching.save({class_information: classInformationId},
            {teacher_id: teacherId,subject_id: subjectId}
            )
            .then(response => {
                context.commit('add',response.data)
            });
    },
    destroy(context,{teachingId, classInformationId}){
        return ClassTeaching.delete({class_information: classInformationId,teaching: teachingId})
            .then(response => {
                context.commit('destroy',teachingId)
            });
    }
};

const module = {
    namespaced: true,
    state,mutations,actions
};

export default module;