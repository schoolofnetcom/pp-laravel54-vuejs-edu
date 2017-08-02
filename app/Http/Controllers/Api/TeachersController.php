<?php

namespace SON\Http\Controllers\Api;

use Illuminate\Http\Request;
use SON\Http\Controllers\Controller;
use SON\Models\Teacher;

class TeachersController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('q');

        return $search ?Teacher::whereHas('user', function($query) use($search){
            $query->where('users.name', 'LIKE', '%'.$search.'%');
        })->take(10)->get():[];

    }
}
