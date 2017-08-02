<template>
    <div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Selecionar professor</label>
                    <select class="form-control" name="teachers"></select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Selecionar disciplina</label>
                    <select class="form-control" name="subjects"></select>
                </div>
            </div>
        </div>
        <button class="btn btn-primary" @click="store()">Adicionar</button>
        <br/><br/>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th></th>
                <th>Professor</th>
                <th>Disciplina</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="teaching in teachings">
                <td>
                    <button type="button" class="btn btn-default" @click="destroy(teaching)">
                        <span class="glyphicon glyphicon-trash"></span> Excluir
                    </button>
                </td>
                <td>{{teaching.teacher.user.name}}</td>
                <td>{{teaching.subject.name}}</td>
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
            teachings(){
               return store.state.classTeaching.teachings;
            }
        },
        mounted(){
            store.dispatch('classTeaching/query', this.classInformation);
            let selects = [
                {
                    url: `${ADMIN_CONFIG.API_URL}/teachers`,
                    selector:"select[name=teachers]",
                    processResults(data){
                        return {
                            results: data.map((teacher) => {
                                return {id: teacher.id, text: teacher.user.name}
                            })
                        }
                    }
                },
                {
                    url: `${ADMIN_CONFIG.API_URL}/subjects`,
                    selector:"select[name=subjects]",
                    processResults(data){
                        return {
                            results: data.map((subject) => {
                                return {id: subject.id, text: subject.name}
                            })
                        }
                    }
                }
            ];

            for(let item of selects){
                $(item.selector).select2({
                    ajax: {
                        url: item.url,
                        dataType: 'json',
                        delay: 250,
                        data(params){
                            return {
                                q: params.term
                            }
                        },
                        processResults: item.processResults
                    },
                    minimumInputLength: 1,
                });
            }
        },
        methods: {
            destroy(teaching){
                if(confirm('Deseja remover este ensino')){
                    store.dispatch('classTeaching/destroy', {
                        teachingId: teaching.id,
                        classInformationId: this.classInformation
                    })
                }
            },
            store(){
                store.dispatch('classTeaching/store',{
                    teacherId: $("select[name=teachers]").val(),
                    subjectId: $("select[name=subjects]").val(),
                    classInformationId: this.classInformation
                }).then(response => {
                    new PNotify({
                        title: 'Aviso',
                        text: 'Ensino adicionado com sucesso',
                        styling: 'brighttheme',
                        type: 'success'
                    });
                })
            }
        }
    }
</script>
