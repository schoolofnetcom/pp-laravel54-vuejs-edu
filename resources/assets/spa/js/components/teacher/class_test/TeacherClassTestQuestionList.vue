<template>
    <div>
        <div class="panel panel-primary" v-for="(question,index) in classTest.questions">
            <div class="panel-heading">
                <button class="btn btn-info btn-sm" @click.prevent="editQuestion(question)">
                    <span class="glyphicon glyphicon-pencil"></span>
                </button>
                <button class="btn btn-danger btn-sm" @click.prevent="deleteQuestion(index)">
                    <span class="glyphicon glyphicon-trash"></span>
                </button>
                {{question.question}} - {{question.point}}
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    <li class="list-group-item" v-for="choice in question.choices">
                        <span class="glyphicon glyphicon-ok" v-if="choice['true']"></span>
                        {{choice.choice}}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
    import store from '../../../store/store';

    export default {
        computed: {
            classTest() {
                return this.$deepModel('teacher.classTest.classTest')
            },
        },
        methods: {
            editQuestion(question){
              store.commit('teacher/classTest/setQuestion',question);
            },
            deleteQuestion(index) {
                store.commit('teacher/classTest/deleteQuestion', index);
            }
        }
    }
</script>