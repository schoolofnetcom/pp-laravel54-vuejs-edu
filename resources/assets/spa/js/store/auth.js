import JwtToken from '../services/jwt-token';

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

    }
};

const actions = {
    login(context, {username, password}){
        return JwtToken.accessToken(username, password)
            .then(() => {
                context.commit('authenticated');
            });
    },
    logout(){
        return JwtToken.revokeToken();
    }
};

const module = {
    namespaced: true,
    state, mutations, actions
};

export default module;