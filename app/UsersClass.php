<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersClass extends Model
{
    protected $table = 'classes';

    protected $fillable = ['name', 'professor_id', 'lesson_id'];

    public function professor()
    {
        return $this->hasOne('App\User', 'id', 'professor_id');
    }

    public function lesson()
    {
        return $this->hasOne('App\Lesson', 'id', 'lesson_id');
    }

    public function students()
    {
        return $this->hasMany('App\ClassesStudent', 'class_id', 'id');
    }

    public function documents()
    {
        return $this->hasMany('App\ClassesDocument', 'class_id', 'id');
    }
}
