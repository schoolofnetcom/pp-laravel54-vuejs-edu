<template>
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>
                    Avaliações de
                    <small>{{classInformationName}}</small>
                </h1>
            </div>

            <router-link :to="routeClassTestCreate" class="btn btn-primary">
                Nova avaliação
            </router-link>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Início</th>
                    <th>Fim</th>
                    <th>Questões</th>
                    <th>Pontos</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="classTest in classTests">
                    <td>{{classTest.name}}</td>
                    <td>{{classTest.date_start}}</td>
                    <td>{{classTest.date_end}}</td>
                    <td>{{classTest.total_questions}}</td>
                    <td>{{classTest.total_points}}</td>
                    <td>
                        <router-link :to="routeClassTestEdit(classTest.id)">
                            Editar
                        </router-link> |
                        <a href="#" @click.prevent="deleteClassTest(classTest)">
                            Excluir
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script type="text/javascript">
    import store from '../../../store/store';
    import classInformationMixin from '../../../mixins/class_information.mixin';

    export default {
        mixins: [classInformationMixin],
        computed: {
            storeType() {
                return 'teacher';
            },
            classTests() {
                return store.state.teacher.classTest.classTests;
            },
            routeClassTestCreate(){
                return {
                    name: 'teacher.class_tests.create_data',
                    params: {
                        'class_teaching': this.$route.params.class_teaching
                    }
                }
            }
        },
        mounted() {
            let classTeachingId = this.$route.params.class_teaching;
            store.dispatch('teacher/classTeaching/get',classTeachingId);
            store.dispatch('teacher/classTest/query', classTeachingId);
        },
        methods: {
            routeClassTestEdit(classTestId){
                return {
                    name: 'teacher.class_tests.update_data',
                    params: {
                        class_teaching: this.$route.params.class_teaching,
                        class_test: classTestId
                    }
                }
            },
            deleteClassTest(classTest){
                if(confirm('Deseja excluir esta avaliação')){
                    store.dispatch('teacher/classTest/delete',{
                        classTeachingId: this.$route.params.class_teaching,
                        classTestId: classTest.id
                    })
                }
            }
        }
    }
</script>
