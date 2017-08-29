<template src="../templates/menu.html"></template>

<script type="text/javascript">
    import authMixin from '../../mixins/auth.mixin';
    import menuMixin from '../../mixins/menu.mixin';

    export default {
        mixins: [menuMixin],
        data(){
            return {
                menus: [
                    {name: "Minhas turmas", routeName: 'student.class_informations.list'}
                ],
                brandRouteName: 'student.class_informations.list'
            }
        },
    };
</script>