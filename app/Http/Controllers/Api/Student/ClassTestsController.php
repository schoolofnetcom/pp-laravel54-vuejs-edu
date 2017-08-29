<?php

namespace SON\Http\Controllers\Api\Student;

use SON\Http\Controllers\Controller;
use SON\Models\ClassTeaching;
use SON\Models\ClassTest;
use SON\Models\StudentClassTest;

class ClassTestsController extends Controller
{
    public function index(ClassTeaching $classTeaching)
    {
        $studentId = \Auth::user()->userable->id;
        $results = ClassTest
            ::where('class_teaching_id', $classTeaching->id)
            ->byStudent($studentId)
            ->get();
        $results = array_map(function($classTest) use($studentId){
            $studentClassTest = StudentClassTest
                ::where('class_test_id',$classTest['id'])
                ->where('student_id',$studentId)
                ->first();
            if($studentClassTest){
                $classTest['student_class_test']['id'] = $studentClassTest->id;
                if(ClassTest::greatherDateEnd30Minutes($classTest['date_end'])){
                    $classTest['student_class_test']['point'] = $studentClassTest->point;
                }
            }
            return $classTest;
        },$results->toArray());
        return $results;
    }

    public function show(ClassTeaching $classTeaching, $id)
    {
        $result = ClassTest
            ::byStudent(\Auth::user()->userable->id)
            ->findOrFail($id);

        $array = $result->toArray();

        $array['questions'] = array_map(function ($question) use($array) {

            if(!ClassTest::greatherDateEnd30Minutes($array['date_end'])) {
                $question['choices'] = array_map(function ($choice) use ($array){
                    unset($choice['true']);
                    return $choice;
                }, $question['choices']->toArray());
            }

            return $question;

        }, $result->questions->toArray());

        return $array;
    }
}
