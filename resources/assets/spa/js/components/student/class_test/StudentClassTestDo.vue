<template>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="page-header">
                    <h3>
                        Avaliação de <br/>
                        <small>
                            <strong>Turma:</strong> {{classInformationName}}
                        </small>
                        <br/>
                        <small>
                            <strong>Pontos:</strong> {{classTestPoints}}
                        </small>
                        <br/>
                        <small>
                            <strong>Início:</strong> {{classTestDateStart}}
                        </small>
                        <br/>
                        <small>
                            <strong>Fim:</strong> {{classTestDateEnd}}
                        </small>
                    </h3>
                </div>
                <button class="btn btn-primary btn-block" @click="save"
                        v-if="!studentClassTest.id">Salvar</button>
            </div>
            <div class="col-md-9" v-if="classTest">
                <ol class="nav nav-pills">
                    <li v-for="(question,index) in classTest.questions">
                        <a href="#" @click.prevent="setQuestion(question)">
                            <span class="label" :class="defineColorQuestion(question)">
                                Quest. #{{index+1}}
                            </span>
                        </a>
                    </li>
                </ol>
            </div>
        </div>
        <student-class-test-question></student-class-test-question>
    </div>
</template>
<script type="text/javascript">
    import store from '../../../store/store';
    import classInformationMixin from '../../../mixins/class_information.mixin';

    export default {
        components: {
            'student-class-test-question': require('./StudentClassTestQuestion.vue')
        },
        mixins: [classInformationMixin],
        computed: {
            storeType() {
                return 'student';
            },
            classTest() {
                return store.state.student.classTest.classTest;
            },
            classTestPoints() {
                let classTest = this.classTest;
                return classTest ? classTest.total_points : 0;
            },
            classTestDateStart() {
                let classTest = this.classTest;
                return classTest ? this.$options.filters.dateTimeBr(classTest.date_start) : '';
            },
            classTestDateEnd() {
                let classTest = this.classTest;
                return classTest ? this.$options.filters.dateTimeBr(classTest.date_end) : '';
            },
            studentClassTest(){
                return store.state.student.studentClassTest.studentClassTest;
            },
            choices(){
                return this.studentClassTest.choices;
            }
        },
        mounted() {
            let classTeachingId = this.$route.params.class_teaching;
            let classInformationId = this.$route.params.class_information;
            let classTestId = this.$route.params.class_test;
            let studentClassTestId = this.$route.params.student_class_test;
            store.dispatch('student/classTeaching/get', {classInformationId, classTeachingId});
            store.dispatch('student/classTest/get', {classTeachingId, classTestId})
                .then(() => {
                    let question = this.classTest.questions[0];
                    store.commit('student/classTest/setQuestion',question);
                });
            if(studentClassTestId){
                store.dispatch('student/studentClassTest/get',{classTestId,studentClassTestId});
            }
        },
        methods: {
            setQuestion(question){
                store.commit('student/classTest/setQuestion',question);
            },
            defineColorQuestion(question){
                return {
                    'label-default': !this.choices.hasOwnProperty(question.id),
                    'label-primary': this.choices.hasOwnProperty(question.id),
                    'label-success': store.getters['student/classTest/isTrue'](question,this.choices[question.id]),
                    'label-danger': this.studentClassTest.id && !store.getters['student/classTest/isTrue'](question,this.choices[question.id])
                }
            },
            save() {
                let classTeachingId = this.$route.params.class_teaching;
                let classInformationId = this.$route.params.class_information;
                let afterSave = () => {
                    new PNotify({
                        title: 'Informação',
                        text: 'Avaliação salva com sucesso',
                        styling: 'brighttheme',
                        type: 'success'
                    });
                    this.$router.push({
                        name: 'student.class_tests.list',
                        params: {
                            class_information: classInformationId,
                            class_teaching: classTeachingId,
                        }
                    });
                };
                let error = (responseError) => {
                    let messageError = 'Não foi possível realizar a operação! Tente novamente.';
                    switch (responseError.status) {
                        case 422:
                            messageError = 'Informações inválidas! Verifique os dados da avaliação novamente.'
                            break;
                    }
                    new PNotify({
                        title: 'Mensagem de erro',
                        text: messageError,
                        styling: 'brighttheme',
                        type: 'error'
                    });
                };
                store.dispatch('student/studentClassTest/create', this.$route.params.class_test)
                    .then(afterSave, error);
            }
        }
    }
</script>

<style type="text/css" scoped>
    .nav > li > a {
        padding: 0px;
    }

    .page-header {
        margin-top: 0px;
    }
</style>