<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Service;

class Service extends Model
{
    protected $guarded = ['id'];
    public function firm(){
        return $this->belongsTo('App\Firm');
    }
    public function simage(){
        return $this->hasOne('App\Simage');
    }
    public function category(){
        return $this->belongsTo('App\Category');
    }
    public function sub_category(){
        return $this->belongsTo('App\SubCategory');
    }
}
