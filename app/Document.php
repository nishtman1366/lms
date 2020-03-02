<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = ['title', 'professor_id', 'lesson_id'];

    public function professor()
    {
        return $this->belongsTo('App\Professor', 'professor_id', 'id');
    }

    public function lesson()
    {
        return $this->belongsTo('App\Lesson', 'lesson_id', 'id');
    }

    public function files()
    {
        return $this->hasMany('App\File', 'document_id', 'id');
    }
}
