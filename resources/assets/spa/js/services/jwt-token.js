import {Jwt} from './resources';
import LocalStorage from './localstorage';
import {Buffer} from 'buffer/';

const payloadToObject = (token) => {
    let payload = token.split('.')[1];
    //return JSON.parse(atob(payload));
    return JSON.parse(Buffer.from(payload,'base64').toString());
};

const TOKEN = 'token'

export default {
    get token(){
        return LocalStorage.get(TOKEN);
    },
    set token(value){
        value ? LocalStorage.set(TOKEN,value):LocalStorage.remove(TOKEN);
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
        let afterRevokeToken = () => {
            this.token = null;
        };
        return Jwt.logout()
            .then(afterRevokeToken)
            .catch(afterRevokeToken);
    },
    getAuthorizationHeader(){
        return `Bearer ${LocalStorage.get(TOKEN)}`;
    }
};