import 'vue-resource';
import SPA_CONFIG from './spaConfig';
import Vue from 'vue';
import JwtToken from './jwt-token';
import store from '../store/store';
import router from '../router';

Vue.http.options.root = SPA_CONFIG.API_URL;

Vue.http.interceptors.push((request,next) => {
    if(JwtToken.token) {
        request.headers.set('Authorization', JwtToken.getAuthorizationHeader());
    }
    next();
});

Vue.http.interceptors.push((request,next) => {
    next((response) => {
        let authorization = response.headers.get('Authorization');
        if(authorization){
            JwtToken.token = authorization.split(' ')[1];
        }
        switch (response.status){
            case 401:
                JwtToken.token = null;
                store.commit('auth/unauthenticated');
                return router.push({name: 'login'});
        }
    })
});

export class Jwt{
    static accessToken(username, password){
        return Vue.http.post('access_token',{username,password});
    }

    static logout(){
        return Vue.http.post('logout');
    }
}

const Teacher = {
    classInformation: Vue.resource('teacher/class_informations/{class_information}'),
    classTeaching: Vue.resource('teacher/class_teachings/{class_teaching}'),
    classTest: Vue.resource('teacher/class_teachings/{class_teaching}/class_tests/{class_test}')
};

const Student = {
    classInformation: Vue.resource('student/class_informations/{class_information}'),
    classTeaching: Vue.resource('student/class_informations/{class_information}/class_teachings/{class_teaching}'),
    classTest: Vue.resource('student/class_teachings/{class_teaching}/class_tests/{class_test}'),
    studentClassTest: Vue.resource('student/class_tests/{class_test}/do/{student_class_test}'),
    classTestResult: Vue.resource('',{},{
        perSubject: {
            method: 'GET',
            url: 'student/class_tests/results/per_subject?class_teaching={class_teaching}'
        }
    })
};

export {
    Teacher, Student
};