<?php

use App\User;
use Illuminate\Foundation\Inspiring;
use Spatie\Permission\Models\Role;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('createRole {name} {displayName}', function (string $name, string $displayName) {
    $role = new Role();
    $role->name = $name;
    $role->display_name = $displayName;
    $role->save();
    print(PHP_EOL);
    print($role->display_name . ' has been created');
})->describe('Create Roles');

Artisan::command('assignRole {username} {roleName}', function (string $username, string $roleName) {
    $user = User::where('username', $username)->get()->first();
    $user->assignRole($roleName);
    print(PHP_EOL);
    print_r($user);
})->describe('Create Roles');
