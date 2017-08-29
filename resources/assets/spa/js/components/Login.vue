<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>
                    <div class="panel-body">

                        <form class="form-horizontal" method="POST" @submit.prevent="login()">
                            <div class="form-group">
                                <label for="username" class="col-md-4 control-label">User</label>

                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control" name="username" required autofocus  v-model="user.username">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="col-md-4 control-label">Password</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required  v-model="user.password">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
    import store from '../store/store';

    export default {
        data(){
            return {
                user: {
                    username: '',
                    password: ''
                }
            }
        },
        methods: {
            login(){
                store.dispatch('auth/login',this.user)
                    .then(() => {
                        this.$router.push({name: 'teacher.class_teachings.list'});
                    });
            }
        }
    }
</script>