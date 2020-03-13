<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\Professor;
use App\UsersClass;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ClassController extends Controller
{
    public function index(Request $request)
    {
        $classes = UsersClass::orderBy('id', 'DESC')->get();
        return view('dashboard.classes', compact('classes'));
    }

    public function form(Request $request)
    {
        $class = null;
        $classId = $request->route('id', null);
        if (!is_null($classId))
            $class = UsersClass::find($classId);
        $professors = Professor::orderBy('name', 'ASC')->get();
        $lessons = Lesson::orderBy('name', 'ASC')->get();
        return view('dashboard.classes_form', compact('class', 'professors', 'lessons'));
    }


    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'professor_id' => 'required',
            'lesson_id' => 'required',
        ]);
        UsersClass::create($request->all());

        return redirect()->route('dashboard.classes.list')->withInput(['message' => 'با موفقیت انجام شد.']);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'professor_id' => 'required',
            'lesson_id' => 'required',
        ]);
        $classId = $request->route('id', null);
        if (!is_null($classId)) {
            $class = UsersClass::find($classId);
            if (is_null($class))
                return redirect()->back()->withErrors(['message' => 'کلاس مورد نظر یافت نشد']);
            $class->fill($request->all());
            $class->save();
            return redirect()->route('dashboard.classes.list')->withInput(['message' => 'با موفقیت انجام شد.']);
        }
        return redirect()->route('dashboard.classes.list');
    }

    public function viewClass(Request $request)
    {
        $id = $request->route('id', null);
        if (is_null($id)) throw new NotFoundHttpException('اطلاعات وراد شده اشتباه است');
        $class = UsersClass::with('documents')->where('id', $id)->get()->first();

        return view('dashboard.classes.view_class', compact('class'));
    }
}
