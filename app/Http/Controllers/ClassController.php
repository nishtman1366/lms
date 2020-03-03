<?php

namespace App\Http\Controllers;

use App\UsersClass;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index(Request $request)
    {
        $classes = UsersClass::orderBy('id', 'DESC')->get();
        return view('dashboard.classes', compact('classes'));
    }
}
