<template>
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>
                    Nova Avaliação de
                    <small>
                        {{classInformationName}}
                    </small>
                </h1>
            </div>
            <div class="well well-sm">
                {{classTest.name}} | {{classTest.date_start}} à {{classTest.date_end}}
            </div>
            <div class="col-md-12">
                <button class="btn btn-primary btn-block" @click="save"
                :disabled="!classTest.questions.length">Criar avaliação</button>
            </div>
            <br/><br/>
            <div class="col-md-6">
                <teacher-class-test-question-form></teacher-class-test-question-form>
            </div>
            <div class="col-md-6">
                <teacher-class-test-question-list></teacher-class-test-question-list>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
    import store from '../../../store/store';
    import classInformationMixin from '../../../mixins/class_information.mixin';

    export default {
        components: {
            'teacher-class-test-question-form': require('./TeacherClassTestQuestionForm.vue'),
            'teacher-class-test-question-list': require('./TeacherClassTestQuestionList.vue'),
        },
        mixins: [classInformationMixin],
        computed: {
            storeType() {
                return 'teacher';
            },
            classTest() {
                return this.$deepModel('teacher.classTest.classTest');
            },
        },
        mounted() {
            store.dispatch('teacher/classTeaching/get', this.$route.params.class_teaching);
            let classTestId = this.$route.params.class_test;
            if(typeof this.classTest.id =="undefined" && classTestId){
                let classTeachingId = this.$route.params.class_teaching;
                store.dispatch('teacher/classTest/get',{
                    classTeachingId: classTeachingId,
                    classTestId: classTestId
                })
            }
        },
        methods: {
            save(){
                let classTeachingId = this.$route.params.class_teaching;
                let afterSave = () => {
                    new PNotify({
                        title: 'Informação',
                        text: 'Avaliação salva com sucesso',
                        styling: 'brighttheme',
                        type: 'success'
                    });
                    this.$router.push({
                        name: 'teacher.class_tests.list',
                        params: {
                            class_teaching: classTeachingId
                        }
                    });
                };
                let error = (responseError) => {
                    let messageError = 'Não foi possível realizar a operação! Tente novamente.';
                    switch (responseError.status){
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
                if(typeof this.classTest.id =="undefined"){
                    store.dispatch('teacher/classTest/create',classTeachingId)
                        .then(afterSave,error);
                }else{
                    store.dispatch('teacher/classTest/update',{
                        classTeachingId,
                        classTestId: this.classTest.id
                    })
                        .then(afterSave,error);
                }
            }
        }
    }
</script>