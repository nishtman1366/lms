<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = $this->listUsers(null, true, 20);
        $groups = Role::where('id', '!=', 1)->orderBy('id', 'ASC')->get();
        return view('dashboard.users', compact('users', 'groups'));
    }

    public function listUsers($usersType = null, $pagination = false, $count = 15)
    {
        if (is_null($usersType)) $users = User::orderBy('id', 'ASC');
        else $users = User::role($usersType)->orderBy('id', 'ASC');
        if ($pagination === true) $usersList = $users->paginate($count);
        else $usersList = $users->get();

        return $usersList;
    }


    public function upload(Request $request)
    {
        $uploadedFile = $request->file('users_file')->store('temp');
        $role = $request->get('user_groups', 'student');
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
        return redirect()->route('dashboard.users.list')->withInput(['message' => 'با موفقیت انجام شد.']);
    }
}
