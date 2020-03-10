<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    public $fillable = ['name', 'code'];

    public function documents()
    {
        return $this->hasMany('App\Document', 'lesson_id', 'id');
    }
}
