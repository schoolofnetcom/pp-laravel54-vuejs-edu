<?php

use Illuminate\Database\Seeder;

class StudentClassTestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classTests = \SON\Models\ClassTest::byTeacher(1)->get();

        foreach ($classTests as $classTest){
            $classTeaching = $classTest->classTeaching;
            $classInformation = $classTeaching->classInformation;
            $students = $classInformation->students;
            $totalStudents = (int)($students->count() * 0.7);
            $studentsRandom = $students->random($totalStudents);
            $halfStudents = $studentsRandom->count()/2;
            $studentsRandom100 = $studentsRandom->slice(0,$halfStudents);
            $self = $this;
            $studentsRandom100->each(function($student) use($self,$classTest){
                $self->makeResults($student,$classTest,1);
            });
            $studentsRandom60 = $studentsRandom->slice($halfStudents,$studentsRandom->count());
            $studentsRandom60->each(function($student) use($self,$classTest){
                $self->makeResults($student,$classTest,0.6);
            });
        }
    }

    public function makeResults($student,$classTest, $perc){
        $questions = $classTest->questions;
        $numQuestionsCorrect = (int)($questions->count() * $perc);
        $questionsCorrect = $questions->slice(0,$numQuestionsCorrect);
        $questionsIncorrect = $questions->slice($numQuestionsCorrect,$questions->count());
        $choices = [];
        foreach ($questionsCorrect as $question){
            $choices[] = [
                'question_id' => $question->id,
                'question_choice_id' => $question->choices->first()->id
            ];
        }

        foreach ($questionsIncorrect as $question){
            $choices[] = [
                'question_id' => $question->id,
                'question_choice_id' => $question->choices->last()->id
            ];
        }

        \Illuminate\Database\Eloquent\Model::reguard();
        \SON\Models\StudentClassTest::createFully([
            'class_test_id' => $classTest->id,
            'student_id' => $student->id,
            'choices' => $choices
        ]);
        \Illuminate\Database\Eloquent\Model::unguard();
    }
}
