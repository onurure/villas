<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $guarded = ['id'];
	public function sub_categories() {
		return $this->hasMany('App\SubCategory');
	}
	public function services(){
		return $this->hasMany('App\Service');
	}
}
