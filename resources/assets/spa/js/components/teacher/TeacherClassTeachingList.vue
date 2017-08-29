<template>
    <div class="container">
        <div class="row">
            <h3>Minhas turmas</h3>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Data Início</th>
                    <th>Data Fim</th>
                    <th>Turma</th>
                    <th>Disciplina</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="classTeaching in classTeachings">
                    <td>{{classTeaching.class_information.date_start | dateBr}}</td>
                    <td>{{classTeaching.class_information.date_end | dateBr}}</td>
                    <td>{{classTeaching.class_information | classInformationAlias}}</td>
                    <td>{{classTeaching.subject.name}}</td>
                    <td>
                        <router-link :to="{name: 'teacher.class_tests.list', params: {class_teaching: classTeaching.id} }">
                            Avaliações
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
            classTeachings() {
                return store.state.teacher.classTeaching.classTeachings;
            }
        },
        mounted() {
            store.dispatch('teacher/classTeaching/query');
        }
    }
</script>