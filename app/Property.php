<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function image(){
        return $this->hasOne('App\Image');
    }
}
