<template>
    <div class="container">
        <div class="row">
            <h3>Minhas turmas</h3>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Data Início</th>
                    <th>Data Fim</th>
                    <th>Apelido</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="classInformation in classInformations">
                    <td>{{classInformation.date_start | dateBr}}</td>
                    <td>{{classInformation.date_end | dateBr}}</td>
                    <td>{{classInformation | classInformationAlias}}</td>
                    <td>
                        <router-link :to="{name: 'student.class_teachings.list', params: {class_information: classInformation.id}}">
                            Disciplinas
                        </router-link>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script type="text/javascript">
    import store from '../../store/store';

    export default {
        computed: {
            classInformations() {
                return store.state.student.classInformation.classInformations;
            }
        },
        mounted() {
            store.dispatch('student/classInformation/query');
            //store.dispatch('student/classInformation/get',5);
        }
    }
</script>