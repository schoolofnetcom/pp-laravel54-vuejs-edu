<?php

namespace SON\Http\Controllers\Api;

use Illuminate\Http\Request;
use SON\Http\Controllers\Controller;
use SON\Models\Subject;

class SubjectsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('q');

        return $search ?Subject::where('name','LIKE', '%'.$search.'%')->get():[];

    }
}
