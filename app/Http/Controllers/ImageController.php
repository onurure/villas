<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;

class ImageController extends Controller
{
    public function Index($p_id){
		$image = Property::Find($p_id)->image;
		return view('user.image', compact('image'));
	}
	public function Save(Request $req){
		$file = $req->file('file');
		//$filename = uniqid().$file->getClientOriginalName();
		//$path = $file->store('public/images');
		$extension = $file->extension();
		$newfilename = uniqid('vll_').".".$extension;
		$filenamearray = explode('.'.$extension,$newfilename);
		$filename = $filenamearray[0];
        $file->move("/home/onururec/villa.onurure.com/images/villas", $newfilename);
		$return = [];
		$return['name'] = $filename;
		$return['fullname'] = $newfilename;
		return $return;
	}
	public function SaveS(Request $req){
		$file = $req->file('file');
		//$filename = uniqid().$file->getClientOriginalName();
		//$path = $file->store('public/services/images');
		$newfilename = $file->hashName();
		$extension = $file->extension();
		$filenamearray = explode('.'.$extension,$newfilename);
		$filename = $filenamearray[0];
        $file->move('/home/villastock/public_html/images/services', $newfilename);
		$return = [];
		$return['name'] = $filename;
		$return['fullname'] = $newfilename;
		return $return;
	}
}
