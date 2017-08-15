import {Jwt} from './resources';
import LocalStorage from './localstorage';

const payloadToObject = (token) => {
    let payload = token.split('.')[1];
    return JSON.parse(atob(payload));
};

export default {
    get token(){
        return LocalStorage.get('token');
    },
    set token(value){
        LocalStorage.set('token',value);
    },
    get payload(){
        return this.token!=null?payloadToObject(this.token):null;
    },
    accessToken(username, password){
        return Jwt.accessToken(username,password)
            .then((response) => {
                this.token = response.data.token;
            })
    },
    revokeToken(){

    }
};