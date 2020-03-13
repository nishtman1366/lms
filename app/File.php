<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['document_id', 'name', 'size'];

    protected $appends = ['url','fileSize'];

    public function getUrlAttribute()
    {
        return url('storage/documents/' . $this->attributes['document_id'] . '/' . $this->attributes['name']);
    }

    public function getFileSizeAttribute()
    {
        return $this->humanFileSize($this->attributes['size']);
    }

    function humanFileSize($bytes, $dec = 2)
    {
        $size = array('بایت', 'کیلوبایت', 'مگابایت', 'گیگابایت', 'ترابایت', 'PB', 'EB', 'ZB', 'YB');
        $factor = floor((strlen($bytes) - 1) / 3);

        return sprintf("%.{$dec}f", $bytes / pow(1024, $factor)) .' '. @$size[$factor];
    }
}
