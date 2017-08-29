<template>
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>
                    Avaliações de
                    <small>{{classInformationName}}</small>
                </h1>
            </div>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Início</th>
                    <th>Fim</th>
                    <th>Questões</th>
                    <th>Pontos</th>
                    <th>Meus pontos</th>
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
                    <td v-if="classTest.student_class_test">
                        {{classTest.student_class_test.point}}
                    </td>
                    <td v-else></td>
                    <td>
                        <template
                                v-if="!classTest.student_class_test && afterStart(classTest.date_start) && beforeEnd(classTest.date_end)">
                            <router-link :to="routeClassTestDo(classTest)">
                                Começar
                            </router-link>
                        </template>
                        <template v-if="classTest.student_class_test && classTest.student_class_test.point">
                            <router-link :to="routeClassTestDo(classTest)">
                                Ver
                            </router-link>
                        </template>
                        <template v-if="classTest.student_class_test && !classTest.student_class_test.point">
                            Em análise
                        </template>
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
    import moment from 'moment';

    export default {
        mixins: [classInformationMixin],
        computed: {
            storeType() {
                return 'student';
            },
            classTests() {
                return store.state.student.classTest.classTests;
            }
        },
        mounted() {
            let classTeachingId = this.$route.params.class_teaching;
            let classInformationId = this.$route.params.class_information;
            store.dispatch('student/classTeaching/get', {classInformationId, classTeachingId});
            store.dispatch('student/classTest/query', classTeachingId);
        },
        methods: {
            afterStart(date) {
                let date1 = moment(date, moment.ISO_8601).toDate();
                return new Date().getTime() >= date1.getTime();
            },
            beforeEnd(date) {
                let date1 = moment(date, moment.ISO_8601).toDate();
                return new Date().getTime() <= date1.getTime();
            },
            routeClassTestDo(classTest) {
                return {
                    name: 'student.class_tests.do',
                    params: {
                        class_information: this.$route.params.class_information,
                        class_teaching: this.$route.params.class_teaching,
                        class_test: classTest.id,
                        student_class_test: classTest.student_class_test ? classTest.student_class_test.id : null
                    }
                }
            }
        }
    }
</script>
