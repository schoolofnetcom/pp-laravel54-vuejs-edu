<?php

namespace SON\Http\Controllers\Api\Teacher;

use Illuminate\Http\Request;
use SON\Http\Controllers\Controller;
use SON\Models\ClassInformation;

class ClassInformationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = ClassInformation
            ::byTeacher(\Auth::user()->userable->id)
            ->get();

        return $results;
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = ClassInformation
            ::byTeacher(\Auth::user()->userable->id)
            ->findOrFail($id);
        return $result;
    }
}
