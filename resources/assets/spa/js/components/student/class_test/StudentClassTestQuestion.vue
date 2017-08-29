<template>
    <div class="row" v-if="question">
        <h3>Questão #{{questionIndex+1}}</h3>
        <div class="panel" :class="panelColor()">
            <div class="panel-heading">
                {{question.question}} - {{question.point}}
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    <a href="#" @click.prevent="setChoiceTrue(choice)" v-for="(choice,index) in question.choices">
                        <li class="list-group-item" :class="activeChoice(choice)">
                            <span class="glyphicon glyphicon-ok" v-if="choice['true']"></span>
                            {{index+1}} - {{choice.choice}}
                        </li>
                    </a>
                </ul>
            </div>
        </div>
    </div>
</template>
<script type="text/javascript">
    import store from '../../../store/store';

    export default {
        computed: {
            question(){
                return store.state.student.classTest.question;
            },
            questionIndex(){
                return store.state.student.classTest.questionIndex;
            },
            choices(){
                return store.state.student.studentClassTest.studentClassTest.choices;
            },
            studentClassTest(){
                return store.state.student.studentClassTest.studentClassTest;
            },
        },
        methods: {
            setChoiceTrue(choice){
                store.commit('student/studentClassTest/setChoiceTrue',{choiceId: choice.id,question:this.question});
            },
            activeChoice(choice){
                return {
                    'active': this.choices[this.question.id] == choice.id
                }
            },
            panelColor(){
                let classes = [];
                if(!this.studentClassTest.id){
                    classes.push('panel-primary');
                }else{
                    if(store.getters['student/classTest/isTrue'](this.question,this.choices[this.question.id])){
                        classes.push('panel-success');
                    }else{
                        classes.push('panel-danger');
                    }
                }
                return classes;
            }
        }
    }
</script>