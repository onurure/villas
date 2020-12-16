<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
	protected $guarded = ['id'];
	public function category() {
		return $this->belongsTo('App\Category');
	}
	public function services(){
		return $this->hasMany('App\Service');
	}
}
