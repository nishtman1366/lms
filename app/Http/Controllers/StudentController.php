<?php

namespace App\Http\Controllers;

use App\ClassesStudent;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $classId = $request->route('id');
        $students = ClassesStudent::with('user')->where('class_id', $classId)->paginate(15);
        foreach ($students as $student) {
            $users[] = $student->user;
        }
        return view('dashboard.students', compact('users'));
    }
}
