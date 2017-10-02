<?php

namespace SON\Http\Controllers\Api\Student;

use Carbon\Carbon;
use Illuminate\Http\Request;
use SON\Http\Controllers\Controller;

class ClassTestResultsController extends Controller
{

    public function perSubject(Request $request) //?class_teaching=120
    {
        $sumClassTestPoints = "(select sum(questions.point) from questions where questions.class_test_id = class_tests.id)";
        $selects = [
            'student_class_tests.created_at',
            "(student_class_tests.point/$sumClassTestPoints)*100 as percentage"
        ];
        $results = \DB::table('student_class_tests')
            ->selectRaw(implode(',', $selects))
            ->join('class_tests', 'class_tests.id', '=', 'student_class_tests.class_test_id')
            //->join('class_teachings','class_teachings.id','=','class_tests.class_teaching_id')
            //->join('subjects','subjects.id','=','class_teachings.subject_id')
            ->where('student_id',25)
            ->where('class_tests.class_teaching_id',166)
            ->orderBy('student_class_tests.created_at', 'asc')
            ->get();
        $results->map(function ($item) { //\stdClass
            $item->created_at = (new Carbon($item->created_at))->format(Carbon::ISO8601);
            return $item;
        });
        return $results;
    }
}
