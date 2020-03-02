<?php

namespace App\Http\Controllers;

use App\Professor;
use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    public function index(Request $request)
    {
        $professors = Professor::orderBy('name', 'ASC')->paginate(15);

        return view('dashboard.professors', compact('professors'));
    }

    public function form(Request $request)
    {
        $professor = null;
        $professorId = $request->route('id', null);
        if (!is_null($professorId))
            $professor = Professor::find($professorId);
        return view('dashboard.professors_form', compact('professor'));
    }

    public function create(Request $request)
    {
        Professor::create($request->all());
        return redirect()->route('dashboard.professors.list')->withInput(['message' => 'با موفقیت انجام شد.']);
    }

    public function update(Request $request)
    {
        $professorId = $request->route('id', null);
        if (!is_null($professorId)) {
            $professor = Professor::find($professorId);
            if (is_null($professor))
                return redirect()->back()->withErrors(['message' => 'استاد مورد نظر یافت نشد']);
            $professor->fill($request->all());
            $professor->save();
            return redirect()->route('dashboard.professors.list')->withInput(['message' => 'با موفقیت انجام شد.']);
        }
        return redirect()->route('dashboard.professors.list');
    }

    public function delete(Request $request)
    {
        $professorId = $request->route('id', null);
        if (!is_null($professorId)) {
            $professor = Professor::find($professorId);
            if (is_null($professor))
                return redirect()->back()->withErrors(['message' => 'استاد مورد نظر یافت نشد']);
            $professor->delete();
            return redirect()->route('dashboard.professors.list')->withInput(['message' => 'با موفقیت انجام شد.']);
        }
        return redirect()->route('dashboard.professors.list');
    }
}
