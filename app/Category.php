<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function admin(){

        return $this->belongsTo('App\Admin');
    }

    public function user(){

        return $this->belongsTo('App\User');
    }

    public function neww(){

        return $this->hasMany('App\Neww');
    }

}
