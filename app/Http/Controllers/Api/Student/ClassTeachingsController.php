<?php

namespace SON\Http\Controllers\Api\Student;

use SON\Http\Controllers\Controller;
use SON\Models\ClassInformation;

class ClassTeachingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ClassInformation $classInformation)
    {
        $student = \Auth::user()->userable;
        $results = $student
            ->classInformations()
            ->find($classInformation->id)
            ->teachings;

        return $results;
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ClassInformation $classInformation, $id)
    {
        $student = \Auth::user()->userable;
        $result = $student
            ->classInformations()
            ->find($classInformation->id)
            ->teachings()
            ->findOrFail($id);

        return $result;
    }
}
