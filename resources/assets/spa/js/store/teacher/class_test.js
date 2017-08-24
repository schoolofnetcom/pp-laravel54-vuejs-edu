import {Teacher} from '../../services/resources';

function newChoice(){
    return {
        choice: '',
        'true': false
    };
}

function newQuestion(){
    return {
        question: '',
        point: 1,
        choices: [
            newChoice(),
            newChoice(),
            newChoice(),
            newChoice(),
        ]
    };
}

const state = {
    classTests: [],
    classTest: {
        name: '',
        date_start: '',
        date_end: '',
        questions: []
    },
    question: newQuestion(),
    choiceTrue: null
};

const mutations = {
    setClassTest(state,classTest){
      state.classTest = classTest;
    },
    setClassTests(state,classTests){
        state.classTests = classTests;
    },
    deleteClassTest(state,classTestId){
        let index = state.classTests.findIndex((item) => {
            return item.id == classTestId;
        });
        if(index!=-1){
            state.classTests.splice(index,1);
        }
    },
    addQuestion(state){
        if(typeof state.question.id =="undefined"){
            state.classTest.questions.push(state.question);
        }
        state.question = newQuestion();
        state.choiceTrue = null;
    },
    setQuestion(state,question){
        question.choices = question.choices.map((item) => {
            item.true = item.true?'true':false;
            if(item.true){
                state.choiceTrue = item;
            }
            return item;
        });
        state.question = question;
    },
    deleteQuestion(state,index){
        state.classTest.questions.splice(index,1);
    },
    addChoice(state){
        state.question.choices.push(newChoice());
    },
    deleteChoice(state,index){
        state.question.choices.splice(index,1);
    },
    setChoiceTrue(state,choice){
        if(state.choiceTrue){
            state.choiceTrue.true = false;
        }
        state.choiceTrue = choice;
    }
};

const actions = {
    query(context,classTeachingId){
        return Teacher.classTest.query({class_teaching: classTeachingId})
            .then(response => {
                context.commit('setClassTests',response.data);
            });
    },
    get(context, {classTeachingId,classTestId}){
        return Teacher.classTest.get({class_teaching: classTeachingId, class_test: classTestId})
            .then(response => {
                context.commit('setClassTest',response.data);
            })
    },
    create(context, classTeachingId){
        return Teacher.classTest.save({class_teaching:classTeachingId},context.state.classTest);
    },
    update(context, {classTeachingId,classTestId}){
        return Teacher.classTest.update({
            class_teaching:classTeachingId,class_test:classTestId
        },context.state.classTest);
    },
    'delete'(context,{classTeachingId,classTestId}){
        return Teacher.classTest.delete({
            class_teaching:classTeachingId,class_test:classTestId
        }).then(() => {
            context.commit('deleteClassTest',classTestId);
        });
    }
};

export default {
    namespaced: true,
    state, mutations,actions
}