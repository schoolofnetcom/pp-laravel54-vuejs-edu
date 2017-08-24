<template>
    <form class="form-horizontal" @submit.prevent="addQuestion">
        <div class="form-group">
            <label for="question" class="control-label">Questão</label>
            <textarea id="question" name="question" class="form-control"
                      v-model="question.question"></textarea>
        </div>
        <div class="form-group">
            <label for="point" class="control-label">Pontos</label>
            <input name="point" id="point" class="form-control" v-model="question.point">
        </div>
        <button type="button" class="btn btn-primary" @click="addChoice">
            + Nova alternativa
        </button>
        <table class="table table-striped">
            <thead>
            <tr>
                <th></th>
                <th style="width: 10px">Verd.?</th>
                <th>Alternativa</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(choice,index) in question.choices">
                <td>
                    <a href="#" @click.prevent="deleteChoice(index)">
                        <span class="glyphicon glyphicon-trash"></span>
                    </a>
                </td>
                <td>
                    <input type="radio" name="choice_true" v-model="choice['true']" value="true" @click="uncheck(choice)">
                </td>
                <td>
                    <textarea class="form-control" v-model="choice.choice"></textarea>
                </td>
            </tr>
            </tbody>
        </table>

        <button class="btn btn-success btn-block">Adicionar</button>
    </form>
</template>

<script type="text/javascript">
    import store from '../../../store/store';

    export default {
        computed: {
            question() {
                return this.$deepModel('teacher.classTest.question')
            }
        },
        methods: {
            addQuestion() {
                store.commit('teacher/classTest/addQuestion');
            },
            addChoice() {
                store.commit('teacher/classTest/addChoice');
            },
            deleteChoice(index) {
                store.commit('teacher/classTest/deleteChoice', index);
            },
            uncheck(choice) {
                store.commit('teacher/classTest/setChoiceTrue', choice);
            }
        }
    }
</script>