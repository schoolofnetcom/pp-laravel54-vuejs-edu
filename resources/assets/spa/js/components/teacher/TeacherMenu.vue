<template src="../templates/menu.html"></template>

<script type="text/javascript">
    import store from '../../store/store';
    export default {
        data(){
            return {
                menus: [
                    {name: "Minhas turmas", routeName: 'class_informations.list'}
                ],
                brandRouteName: 'class_informations.list'
            }
        },
        computed: {
            isAuth(){
                return store.state.auth.check;
            },
            user(){
                return store.state.auth.user;
            },
            username(){
                return this.isAuth?store.state.auth.user.name:null;
            }
        }
    };
</script>