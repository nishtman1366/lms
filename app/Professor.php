<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    public $fillable = ['name'];

    public function documents()
    {
        return $this->hasMany('App\Document', 'professor_id', 'id');
    }
}
