<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
	protected $guarded = ['id'];
	public $timestamps = false;
    public function property(){
        return $this->belongsTo('App\Property');
    }
}
