<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;
use App\Service;
use App\Category;
use App\SubCategory;
use App\Setting;
use App\Translation;
use App\Place;
use Auth;

class YonetimController extends Controller
{
    public function Index(){
		return view('yonetim.index');
	}
    public function Ayarlar(){
        $settings = Setting::Find(1);
        return view('yonetim.ayarlar', compact('settings'));
    }
    public function AyarlarKaydet(Request $req){
        $setting = Setting::Find(1);
        if($req['ucretli']==1){
            $setting->ucretli = 1;
        }else{
            $setting->ucretli = 0;
        }
        $setting->save();
        return back();
    }
    public function Login(Request $req){
        $data = $req->only('email','password');
        if(Auth::guard('admin')->attempt($data)){
            return redirect(url('/yonetim/ilanlar'));
        }
        return redirect()->back()->withErrors(['Hata'=>'Mail adresiniz ya da şifreniz hatalı.']);
	}
    public function Ilanlar(){
        $properties = Property::orderBy('approve', 'DESC')->orderBy('created_at', 'DESC')->get();
        return view('yonetim.ilanlar', compact('properties'));
    }
    public function Servisler(){
        $properties = Service::orderBy('approve', 'DESC')->orderBy('created_at', 'DESC')->get();
        return view('yonetim.servisler', compact('properties'));
    }
    public function Kategoriler(){
        $properties = Category::orderBy('created_at', 'DESC')->get();
        return view('yonetim.kategoriler', compact('properties'));
    }
    public function KatEdit(Request $req,$p_id=""){
        if($req->s==1){
            if($p_id==""){
    			$category = new SubCategory;
    		}else{
    			$category = SubCategory::Find($p_id);
    		}
        }else{
            if($p_id==""){
    			$category = new Category;
    		}else{
    			$category = Category::Find($p_id);
    		}
        }
        $tumparents = Category::all();
		return view('yonetim.kategori', compact('category','tumparents'));
    }
    public function KatSave(Request $req, $p_id=""){
        if($p_id==""){
            if(isset($req->parent)&&$req->parent!=""){
    			$service = new SubCategory;
                $service['category_id'] = $req->parent;
                $service['title'] = $req->title;
            }else{
    			$service = new Category;
                $service['title'] = $req->title;
            }
            $translation = Translation::where('orj',$req->title)->count();
            //dd($translation);
            if($translation>0){

            }else{
                $t = new Translation;
                $t['lan'] = 'tr';
                $t['language'] = 'TR';
                $t['orj'] = $req->title;
                $t->save();
            }
            $service->save();
		}else{
            if(isset($req->parent)&&$req->parent!=""){
    			$service = SubCategory::Find($p_id);
                $service['category_id'] = $req->parent;
                $service['title'] = $req->title;
            }else{
	            $service = Category::Find($p_id);
                $service['title'] = $req->title;
            }
            $service = save();
		}
        return redirect('yonetim/kategoriler');
    }
    public function Diller()
    {
        //$properties = Translation::where('lan','!=','tr')->groupBy('lan')->get();
        $properties = Translation::groupBy('lan')->get();
        return view('yonetim.diller',compact('properties'));
    }
    public function DillerSave(Request $req)
    {
        $turkce = Translation::where('lan','tr')->get();
        foreach ($turkce as $t) {
            $ceviri = new Translation();
            $ceviri->lan = $req['dilk'];
            $ceviri->language = $req['dil'];
            $ceviri->orj = $t->orj;
            $ceviri->save();
        }
        return back();
    }
    public function Dil($p_id="")
    {
        if($p_id==""){
            $properties = new Translation();
        }else{
            $properties = Translation::where('lan',$p_id)->get();
        }
        $turkce = Translation::where('lan','tr')->get();
        return view('yonetim.dil',compact('properties','turkce'));
    }
    public function DilSave(Request $req, $p_id="")
    {
        $turkce = Translation::where('lan','tr')->get();
        foreach($turkce as $t){
            $ceviri = Translation::where('lan',$p_id)->where('orj',$t->orj)->first();
            $ceviri->trans = $req['ceviri'.$t->id];
            $ceviri->save();
        }
        $properties = Translation::where('lan',$p_id)->get();
        return view('yonetim.dil',compact('properties','turkce'));
    }
    public function Onayla(Request $req)
    {
        if($req['islem']=="ilan"){
            $property = Property::Find($req['pid']);
            $property->approve = 1;
            if($property->update()){
                return response()->json(['success' => true]);
            }else{
                return response()->json(['failure' => true]);
            }

        }elseif($req['islem']=="servis"){
            $property = Service::Find($req['pid']);
            $property->approve = 1;
            if($property->update()){
                return response()->json(['success' => true]);
            }else{
                return response()->json(['failure' => true]);
            }

        }
    }
    public function Firmalar()
    {
        $properties = \App\Firm::all();
        return view('yonetim.firmalar',compact('properties'));
    }
    public function Firma($f_id="")
    {
        if($f_id==""){
            $properties = new \App\Firm;
            $son = \App\Firm::orderBy('id', 'DESC')->first();
            $bol = explode('FRM',$son->firmcode);
            $sayi = (int)$bol[1];
            $sayi++;
            if($sayi>99){
                $yeni_id = "FRM".$sayi;
            }else if($sayi>9){
                $yeni_id = "FRM0".$sayi;
            }else{
                $yeni_id = "FRM00".$sayi;
            }
        }else{
            $properties = \App\Firm::Find($f_id);
            $yeni_id = 1;
        }
        return view('yonetim.firma',compact('properties','yeni_id'));
    }
    public function FirmaSave(Request $req,$f_id="")
    {
        if($f_id==""){
            $properties = new \App\Firm;
            $rastgele = rand();
            $req->pass = $rastgele;
            $req->password = bcrypt($rastgele);
            $properties->create($req->all());
            \Mail::to($req->email)->send(new \App\Mail\FirmInfo($req));
        }else{
            $properties = \App\Firm::Find($f_id);
            $properties->fill($req->all());
            $properties->save();
        }
        return redirect('yonetim/firmalar');
    }
    public function Reviews()
    {
        $properties = \App\Review::all();
        return view('yonetim.yorumlar',compact('properties'));
    }
    public function Review($f_id="")
    {
        if($f_id==""){
            $properties = new \App\Review;
        }else{
            $properties = \App\Review::Find($f_id);
        }
        return view('yonetim.yorum',compact('properties'));
    }
    public function ReviewSave(Request $req,$f_id="")
    {
        if($f_id==""){
            $properties = new \App\Review;
            $properties->create($req->all());
        }else{
            $properties = \App\Review::Find($f_id);
            $properties->fill($req->all());
            $properties->save();
        }
        return redirect('yonetim/yorumlar');
    }
    public function Places()
    {
        $properties = \App\Place::all();
        return view('yonetim.yerler',compact('properties'));
    }
    public function Place($f_id="")
    {
        if($f_id==""){
            $properties = new \App\Place;
        }else{
            $properties = \App\Place::Find($f_id);
        }
        return view('yonetim.yer',compact('properties'));
    }
    public function PlaceSave(Request $req,$f_id="")
    {
		$file = $req->file('image');
        //dd($file);
		//$filename = uniqid().$file->getClientOriginalName();
		//$path = $file->store('public/images');
		$newfilename = $file->hashName();
        $req->image = $newfilename;
        $file->move('/home/villastock/public_html/images', $newfilename);
        //dd($path);
        if($f_id==""){
            $properties = new \App\Place;
            //$properties->create($req->all());
            $properties->name = $req['name'];
            $properties->image = $newfilename;
            $properties->save();
        }else{
            $properties = \App\Place::Find($f_id);
            $properties->fill($req->all());
            $properties->save();
        }
        return redirect('yonetim/yerler');
    }
}
