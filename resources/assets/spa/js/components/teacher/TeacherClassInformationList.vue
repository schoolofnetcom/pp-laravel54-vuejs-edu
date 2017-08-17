<template>
    <div class="container">
        <div class="row">
            <h3>Minhas turmas</h3>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Data Início</th>
                    <th>Data Fim</th>
                    <th>Ciclo</th>
                    <th>Subdivisão</th>
                    <th>Semestre</th>
                    <th>Ano</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="classInformation in classInformations">
                    <td>{{classInformation.date_start | dateBr}}</td>
                    <td>{{classInformation.date_end | dateBr}}</td>
                    <td>{{classInformation.cycle}}</td>
                    <td>{{classInformation.subdivision}}</td>
                    <td>{{classInformation.semester}}</td>
                    <td>{{classInformation.year}}</td>
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
                return store.state.teacher.classInformation.classInformations;
            }
        },
        mounted() {
            store.dispatch('teacher/classInformation/query');
        }
    }
</script>