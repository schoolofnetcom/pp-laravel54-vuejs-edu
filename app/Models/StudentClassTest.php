<?php

namespace SON\Models;

use Illuminate\Database\Eloquent\Model;

class StudentClassTest extends Model
{
    protected $fillable = [
        'class_test_id',
        'student_id'
    ];

    public function classTest(){
        return $this->belongsTo(ClassTest::class);
    }

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function choices(){
        return $this->hasMany(StudentQuestionChoice::class);
    }

    public static function createFully(array $data){
        $studentClassTest = parent::create($data);
        foreach ($data['choices'] as $choice){
            //question_id and question_choice_id
            $studentClassTest->choices()->create($choice);
        }
        $studentClassTest->point = self::calculatePoint($studentClassTest);
        $studentClassTest->save();
        return $studentClassTest;
    }

    public static function calculatePoint(StudentClassTest $studentClassTest){
        $questions = $studentClassTest->classTest->questions;
        $studentChoices = $studentClassTest->choices;
        $point = 0;
        foreach ($questions as $question){
            $studentChoice = $studentChoices->where('question_id',$question->id)->first();
            if($studentChoice){
                $choiceTrue = $question->choices()->where('true',true)->first();
                $point += $choiceTrue->id == $studentChoice->question_choice_id
                    ?(float)$question->point:0;
            }
        }
        return $point;
    }
}
