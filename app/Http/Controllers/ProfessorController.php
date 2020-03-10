<?php

namespace App\Http\Controllers;

use App\Professor;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfessorController extends Controller
{

    private $userController;

    /**
     * ProfessorController constructor.
     */
    public function __construct()
    {
        $this->userController = new UserController();
    }

    public function index(Request $request)
    {
        $professors = $this->userController->listUsers('professor', true, 20);
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

    public function upload(Request $request)
    {
        $uploadedFile = $request->file('professors_file')->store('temp');
        $role = 'professor';
        $file = fopen(storage_path('app' . DIRECTORY_SEPARATOR . $uploadedFile), "r");
        while (!feof($file)) {
            $data = fgets($file);
            $d = explode(',', $data);
            if (key_exists(0, $d) && key_exists(1, $d) && key_exists(2, $d) && key_exists(3, $d)) {
                $user = User::updateOrCreate([
                    'first_name' => $d[2],
                    'last_name' => $d[1],
                    'national_code' => $d[0],
                    'username' => $d[3],
                    'email' => null,
                    'password' => Hash::make($d[0]),
                ]);
                $user->assignRole($role);
            }
        }
        fclose($file);
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
