<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassesDocument extends Model
{
    protected $fillable = ['class_id', 'title','description'];

    public function files()
    {
        return $this->hasMany('App\File', 'document_id', 'id');
    }
}
