<template>
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>
                    Nova Avaliação de
                    <small>{{classInformationName}}</small>
                </h1>
            </div>
            <form class="form-horizontal" @submit.prevent="goToQuestions">
                <fieldset>
                    <legend>Informações da avaliação</legend>
                    <div class="form-group col-md-6">
                        <label for="name" class="control-label">Nome</label>
                        <input name="name" id="name" class="form-control" v-model="classTest.name">
                        {{classTest.name}}
                    </div>
                    <div class="form-group col-md-3">
                        <label for="date_start" class="control-label">Início</label>
                        <input id="date_start" type="datetime-local" name="date_start" class="form-control"
                               v-model="classTest.date_start">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="date_end" class="control-label">Fim</label>
                        <input id="date_end" type="datetime-local" name="date_end" class="form-control"
                               v-model="classTest.date_end">
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-primary btn-block">Ir para questões</button>
                    </div>
                </fieldset>
            </form>
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
            classTest() {
                return this.$deepModel('teacher.classTest.classTest');
            },
        },
        mounted() {
            let classTeachingId = this.$route.params.class_teaching;
            store.dispatch('teacher/classTeaching/get', classTeachingId);
            if (this.$route.name == 'teacher.class_tests.update_data') {
                store.dispatch('teacher/classTest/get', {
                    classTeachingId: this.$route.params.class_teaching,
                    classTestId: this.$route.params.class_test
                })
            }
        },
        methods: {
            goToQuestions() {
                this.$router.push(
                    {
                        name: 'teacher.class_tests.questions',
                        params: {
                            class_teaching: this.$route.params.class_teaching,
                            class_test: this.$route.params.class_test
                        }
                    }
                );
            }
        }
    }
</script>