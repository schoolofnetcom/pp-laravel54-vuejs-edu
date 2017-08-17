import LogoutComponent from '../components/Logout.vue';
import authMixin from './auth.mixin';

export default {
    components: {
        'logout': LogoutComponent
    },
    mixins: [authMixin],
}