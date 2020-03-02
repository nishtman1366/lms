<?php

namespace App\Http\Controllers;

use App\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index(Request $request)
    {
        $lessons = Lesson::orderBy('name', 'ASC')->paginate(15);

        return view('dashboard.lessons', compact('lessons'));
    }

    public function form(Request $request)
    {
        $lesson = null;
        $lessonId = $request->route('id', null);
        if (!is_null($lessonId))
            $lesson = Lesson::find($lessonId);
        return view('dashboard.lessons_form', compact('lesson'));
    }

    public function create(Request $request)
    {
        Lesson::create($request->all());
        return redirect()->route('dashboard.lessons.list')->withInput(['message' => 'با موفقیت انجام شد.']);
    }

    public function update(Request $request)
    {
        $lessonId = $request->route('id', null);
        if (!is_null($lessonId)) {
            $lesson = Lesson::find($lessonId);
            if (is_null($lesson))
                return redirect()->back()->withErrors(['message' => 'درس مورد نظر یافت نشد']);
            $lesson->fill($request->all());
            $lesson->save();
            return redirect()->route('dashboard.lessons.list')->withInput(['message' => 'با موفقیت انجام شد.']);
        }
        return redirect()->route('dashboard.lessons.list');
    }

    public function delete(Request $request)
    {
        $lessonId = $request->route('id', null);
        if (!is_null($lessonId)) {
            $lesson = Lesson::find($lessonId);
            if (is_null($lesson))
                return redirect()->back()->withErrors(['message' => 'درس مورد نظر یافت نشد']);
            $lesson->delete();
            return redirect()->route('dashboard.lessons.list')->withInput(['message' => 'با موفقیت انجام شد.']);
        }
        return redirect()->route('dashboard.lessons.list');
    }
}
