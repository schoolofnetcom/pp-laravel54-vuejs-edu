import JwtToken from '../services/jwt-token';

const ROLE_TEACHER = 2;
const ROLE_STUDENT = 3;

const state = {
    user: JwtToken.payload != null ? JwtToken.payload.user : null,
    check: JwtToken.token != null
};

const mutations = {
    authenticated(state){
        state.check = true;
        state.user = JwtToken.payload.user;
    },
    unauthenticated(state){
        state.check = false;
        state.user = null;
    }
};

const actions = {
    login(context, {username, password}){
        return JwtToken.accessToken(username, password)
            .then(() => {
                context.commit('authenticated');
            });
    },
    logout(context){
        let afterLogout = () => {
            context.commit('unauthenticated');
        };
        return JwtToken.revokeToken()
            .then(afterLogout)
            .catch(afterLogout);
    }
};

const getters = {
    isTeacher(state){
        return state.user && state.user.role == ROLE_TEACHER;
    },
    isStudent(state){
        return state.user && state.user.role == ROLE_STUDENT;
    }
}

const module = {
    namespaced: true,
    state, mutations, actions, getters
};

export default module;