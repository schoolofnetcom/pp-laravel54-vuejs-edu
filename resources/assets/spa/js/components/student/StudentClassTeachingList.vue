<template>
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>
                    Disciplinas de
                    <small v-if="classInformation">{{classInformation | classInformationAlias}}</small>
                </h1>
            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Disciplina</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="classTeaching in classTeachings">
                    <td>{{classTeaching.subject.name}}</td>
                    <td>
                        <router-link :to="{name: 'student.class_tests.list', params: {class_teaching: classTeaching.id} }">
                            Avaliações
                        </router-link>|
                        <router-link :to="{name: 'student.chart.per_subject', params: {class_teaching: classTeaching.id} }">
                            Aproveitamento
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
                return store.state.student.classTeaching.classTeachings;
            },
            classInformation(){
                return store.state.student.classInformation.classInformation;
            }
        },
        mounted() {
            let classInformationId = this.$route.params.class_information;
            store.dispatch('student/classInformation/get',classInformationId);
            store.dispatch('student/classTeaching/query',classInformationId);
        },
        methods: {
            routeClassTestList(classTeaching){
                return {
                    name: 'student.class_tests.list',
                    params: {
                        class_information: this.$route.params.class_information,
                        class_teaching: classTeaching.id,
                    }
                }
            }
        }
    }
</script>