<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Simage extends Model
{
	protected $guarded = ['id'];
	public $timestamps = false;
    public function service(){
        return $this->belongsTo('App\Service');
    }
}
