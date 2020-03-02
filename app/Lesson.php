<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    public $fillable = ['name'];

    public function documents()
    {
        return $this->hasMany('App\Document', 'lesson_id', 'id');
    }
}
