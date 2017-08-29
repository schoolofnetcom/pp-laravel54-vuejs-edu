import store from '../store/store';

export default {
    computed: {
        isAuth(){
            return store.state.auth.check;
        },
        user(){
            return store.state.auth.user;
        },
        username(){
            return this.isAuth?store.state.auth.user.name:null;
        },
        isTeacher(){
            return store.getters['auth/isTeacher'];
        }
    }
}