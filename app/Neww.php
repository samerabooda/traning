<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Neww extends Model
{

    protected $appends = ['image_path'];

    public function category(){

        return $this->belongsTo('App\Category');
    }

    public function admin(){
        return $this->belongsTo('App\Admin');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function image(){
        return $this->hasMany('App\ImageDropzone');
    }

    public function getImagePathAttribute(){

        return asset('public/upload/news/'.$this->Main_Image);
    }
}
