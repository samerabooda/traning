<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageDropzone extends Model
{
    protected $fillable = ['path'];
    public function neww(){
        return $this->belongsTo('App\Neww');
    }
}
