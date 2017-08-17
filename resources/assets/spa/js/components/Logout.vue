<template>
    <li>
        <a href="#" @click.prevent="logout()">
            Logout
        </a>
    </li>
</template>

<script type="text/javascript">
    import store from '../store/store';
    import router from '../router';

    export default {
        methods: {
            logout(){
                let goToLogin = () => {
                    router.push({name: 'login'});
                };
                store.dispatch('auth/logout')
                    .then(goToLogin)
                    .catch(goToLogin);
            }
        }
    }
</script>