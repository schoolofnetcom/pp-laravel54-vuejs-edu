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
};

const Student = {

};

export {
    Teacher, Student
};