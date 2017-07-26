<template>
    <div>
        <div class="form-group">
            <label class="control-label">Selecionar estudante</label>
            <select class="form-control" name="students"></select>
        </div>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th></th>
                <th>Nome</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="student in students">
                <td>
                    <button type="button" class="btn btn-default" @click="destroy(student)">
                        <span class="glyphicon glyphicon-trash"></span> Excluir
                    </button>
                </td>
                <td>{{student.user.name}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import ADMIN_CONFIG from '../../services/adminConfig';
    import store from '../../store/store';
    import 'select2';

    export default {
        props: ['classInformation'],
        computed: {
            students(){
                return store.state.classStudent.students;
            }
        },
        mounted(){
            store.dispatch('classStudent/query', this.classInformation);
            $("select[name=students]").select2({
                ajax: {
                    url: `${ADMIN_CONFIG.API_URL}/students`,
                    dataType: 'json',
                    delay: 250,
                    data(params){
                        return {
                            q: params.term
                        }
                    },
                    processResults(data){
                        return {
                            results: data.map((student) => {
                                return {id: student.id, text: student.user.name}
                            })
                        }
                    }
                },
                minimumInputLength: 1,
            });

            let self = this;
            $("select[name=students]").on('select2:select', event => {
                store.dispatch('classStudent/store', {
                    studentId: event.params.data.id,
                    classInformationId: self.classInformation
                }).then(() => {
                  new PNotify({
                      title: 'Aviso',
                      text: 'Aluno adicionado com sucesso',
                      styling: 'brighttheme',
                      type: 'success'
                  });
                });
            })
        },
        methods: {
            destroy(student){
                if(confirm('Deseja remover este aluno')){
                    store.dispatch('classStudent/destroy', {
                        studentId: student.id,
                        classInformationId: this.classInformation
                    })
                }
            }
        }
    }
</script>
