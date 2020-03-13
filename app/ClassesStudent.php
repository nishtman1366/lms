<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassesStudent extends Model
{
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function StudentClass()
    {
        return $this->hasOne('App\UsersClass', 'id', 'class_id');
    }
}
