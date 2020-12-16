<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;
use App\Image;
use Auth;
use Carbon\Carbon;
use App\Setting;
use Illuminate\Support\Facades\Input;

class PropertyController extends Controller
{
    public function __construct(){
        if(!session()->has('doviz')){
            session()->put('doviz', '1');
        }
    }
    public function Index(){
        $properties = Property::where('user_id',Auth::id())->orderBy('created_at', 'DESC')->paginate(20);
        return view('user.my-properties', compact('properties'));
    }
    public function Edit($p_id="")
    {
    	if($p_id==""){
			$property = new Property;
		}else{
			$property = Property::Find($p_id);
		}
        if($property->image){
            $images = json_decode($property->image->image_links);
        }else{
            $images = "";
        }
		return view('user.property', compact('property','images'));
    }
    public function Save(Request $req, $p_id="")
    {
        $this->validate($req, [
            'title' => 'required|min:20',
            'type' =>  'required',
            'price' =>  'required',
            'doviz' =>  'required'
        ]);
        $setting = Setting::Find(1);
    	if($p_id==""){
			$property = new Property;
            $property = $req->except(['images','featured','aaa1','aaa2','aaa3','aaa4','aaa5','aaa6']);
            $property['title_arama'] = url_slug($req->title,['delimiter' => ' ']);
            // $city_arama = url_slug($req->city,['delimiter' => ' ']);
            $address_arama = url_slug($req->address,['delimiter' => ' ']);
            // $country_arama = url_slug($req->country,['delimiter' => ' ']);
            // $district_arama = url_slug($req->district,['delimiter' => ' ']);
            $property['adres_arama'] = $address_arama;
            $property['gmap_arama'] = $req->aaa1." ".$req->aaa2." ".$req->aaa3." ".$req->aaa4." ".$req->aaa5." ".$req->aaa6;
            $property['detail_arama'] = url_slug($req->detail,['delimiter' => ' ']);
            $property['expiration_at'] = Carbon::now()->addDays(30);
            if($req->manzara){
                $property['manzara'] = implode(',',$req['manzara']);
            }
            if($setting->ucretli==0){
                $property['approve'] = 1;
            }
            $property['vitrine'] = 1;
            $new_property = Auth::user()->properties()->create($property);
            if($req['images']){
                $image = new Image();
                if($req->featured){
                    $image['vitrine'] = $req->featured;
                }else{
                    $image['vitrine'] = $req->images[0];
                }
                $image['image_links'] = json_encode($req['images']);
                $new_property->image()->save($image);
            }
		}else{
			$property = Property::Find($p_id);
            if(Auth::id()==$property->user_id){
                $property['title_arama'] = url_slug($req->title,['delimiter' => ' ']);
                $address_arama = url_slug($req->address,['delimiter' => ' ']);
                $property['adres_arama'] = $address_arama;
                $property['detail_arama'] = url_slug($req->detail,['delimiter' => ' ']);
                if($property->googlemap!=$req->googlemap){
                    $property['adres_arama'] = $address_arama;
                    $property['gmap_arama'] = $req->aaa1." ".$req->aaa2." ".$req->aaa3." ".$req->aaa4." ".$req->aaa5." ".$req->aaa6;
                }
                $property->fill($req->except(['images','featured','aaa1','aaa2','aaa3','aaa4','aaa5','aaa6']));
                $property->approve = 0;
                if($setting->ucretli==0){
                    $property['approve'] = 1;
                }
                if($req->manzara){
                    $property['manzara'] = implode(',',$req->manzara);
                }
                $property['vitrine'] = 1;
                $property->save();
                if($property->image){
                    $image = $property->image;
                }else{
                    $image = new Image();
                }
                if($req['images']){
                    if($req->featured){
                        $image['vitrine'] = $req->featured;
                    }else{
                        $image['vitrine'] = $req->images[0];
                    }
                    $image['image_links'] = json_encode($req['images']);
                    $property->image()->save($image);
                }
            }
		}
        return redirect('user/my-properties');
    }
    public function Villas(Request $req, $type){
        $prop_search = [];
        $properties = Property::where('approve',1)->whereDate('expiration_at', '>', Carbon::today()->toDateString());
        if($type && $type != ""){
            if($type == "sale"){
                $properties = $properties->where('type', 1);
            }else{
                $properties = $properties->where('type', 2);
            }
            if(isset($req['kw']) and $req['kw']!=""){
                $aranacak = $req['kw'];
                $aranacak = url_slug($aranacak, ['delimiter' => ' ']);
                $properties = $properties->where(function ($query) use ($aranacak){
                    $query->where('title_arama', 'LIKE', "%{$aranacak}%")
                          ->orWhere('adres_arama', 'LIKE', "%{$aranacak}%")
                          ->orWhere('detail_arama', 'LIKE', "%{$aranacak}%");
                });
            }
            if(isset($req['a1'])&&$req['a1']!=""){
                $properties = $properties->where('gmap_arama','like','%'.$req['a1'].'%');
            }
            if(isset($req['a2'])&&$req['a2']!=""){
                $properties = $properties->where('gmap_arama','like','%'.$req['a2'].'%');
            }
            if(isset($req['a3'])&&$req['a3']!=""){
                $properties = $properties->where('gmap_arama','like','%'.$req['a3'].'%');
            }
            if(isset($req['a4'])&&$req['a4']!=""){
                $properties = $properties->where('gmap_arama','like','%'.$req['a4'].'%');
            }
            if(isset($req['a5'])&&$req['a5']!=""){
                $properties = $properties->where('gmap_arama','like','%'.$req['a5'].'%');
            }
            if(isset($req['a6'])&&$req['a6']!=""){
                $properties = $properties->where('gmap_arama','like','%'.$req['a6'].'%');
            }
            if(isset($req['minp'])&&$req['minp']!=""){
                $properties = $properties->where('price','>=',$req['minp']);
            }
            if(isset($req['maxp'])&&$req['maxp']!=""){
                $properties = $properties->where('price','<=',$req['maxp']);
            }
            if(isset($req['mina'])&&$req['mina']!=""){
                $properties = $properties->where('area','>=',$req['mina']);
            }
            if(isset($req['maxa'])&&$req['maxa']!=""){
                $properties = $properties->where('area','<=',$req['maxa']);
            }
            if(isset($req['ming'])&&$req['ming']!=""){
                $properties = $properties->where('gardenarea','>=',$req['ming']);
            }
            if(isset($req['maxg'])&&$req['maxg']!=""){
                $properties = $properties->where('gardenarea','<=',$req['maxg']);
            }
            if(isset($req['minr'])&&$req['minr']!=""){
                $properties = $properties->where('room','>=',$req['minr']);
            }
            if(isset($req['maxr'])&&$req['maxr']!=""){
                $properties = $properties->where('room','<=',$req['maxr']);
            }
            if(isset($req['mins'])&&$req['mins']!=""){
                $properties = $properties->where('salon','>=',$req['mins']);
            }
            if(isset($req['maxs'])&&$req['maxs']!=""){
                $properties = $properties->where('salon','<=',$req['maxs']);
            }
            if(isset($req['minb'])&&$req['minb']!=""){
                $properties = $properties->where('bathroom','>=',$req['minb']);
            }
            if(isset($req['maxb'])&&$req['maxb']!=""){
                $properties = $properties->where('bathroom','<=',$req['maxb']);
            }
            if(isset($req['minage'])&&$req['minage']!=""){
                $properties = $properties->where('buildingage','>=',$req['minage']);
            }
            if(isset($req['maxage'])&&$req['maxage']!=""){
                $properties = $properties->where('buildingage','<=',$req['maxage']);
            }
            if(isset($req['mind'])&&$req['mind']!=""){
                $properties = $properties->where('seadistance','>=',$req['mind']);
            }
            if(isset($req['maxd'])&&$req['maxd']!=""){
                $properties = $properties->where('seadistance','<=',$req['maxd']);
            }
            if(isset($req['f'])&&$req['f']!=""){
                $properties = $properties->where('furniture','=',$req['f']);
            }
            if(isset($req['manzara'])&&$req['manzara']!=""){
                $manzara = $req['manzara'];
                $properties = $properties->where(function($query) use($manzara)
                                            {
                                            foreach ($manzara as $m) {
                                              $query-> orWhere('manzara','LIKE', "%{$m}%");
                                            }
                                          });
            }
            if(isset($req['detached'])&&$req['detached']!=""){
                $properties = $properties->where('detached','=','1');
            }
            if(isset($req['semidetached'])&&$req['semidetached']!=""){
                $properties = $properties->where('semidetached','=','1');
            }
            if(isset($req['insite'])&&$req['insite']!=""){
                $properties = $properties->where('insite','=','1');
            }
            if(isset($req['garden'])&&$req['garden']!=""){
                $properties = $properties->where('garden','=','1');
            }
            if(isset($req['garden1'])&&$req['garden1']!=""){
                $properties = $properties->where('garden1','=','1');
            }
            if(isset($req['pool'])&&$req['pool']!=""){
                $properties = $properties->where('pool','=','1');
            }
            if(isset($req['pool1'])&&$req['pool1']!=""){
                $properties = $properties->where('pool1','=','1');
            }
            if(isset($req['kidspool'])&&$req['kidspool']!=""){
                $properties = $properties->where('kidspool','=','1');
            }
            if(isset($req['seenpool'])&&$req['seenpool']!=""){
                $properties = $properties->where('seenpool','=','1');
            }
            if(isset($req['garage'])&&$req['garage']!=""){
                $properties = $properties->where('garage','=','1');
            }
            //dd($prop_search);
            //dd($properties);
            $properties = $properties->orderBy('created_at', 'DESC')->paginate(10);
        }else{
            $properties = $properties->orderBy('created_at', 'DESC')->paginate(10);
        }

        //$count = $propertiesM->count();
        //$properties = $propertiesM->get();
        return view('properties', compact('properties'));
    }
    public function Villa($v_id){
        $property = Property::find($v_id);
        if($property->approve==1){
            $property->views = $property->views+1;
            $property->save();
            return view('property', compact('property'));
        }else{
            if(Auth::id()==$property->user_id){
                return view('property', compact('property'));
            }else{
                return back();
            }
        }
    }
    public function Bookmark(){
        if(Auth::user()->favorite){
            $properties = Property::whereIn('id', json_decode(Auth::user()->favorite->property_ids))->get();
        }
        return view('user.bookmark', compact('properties'));
    }
    public function Delete(Request $req){
        $property = Property::find($req['pr_id']);
        if($property->user == Auth::user()){
            $property->delete();
            return response()->json(array('sonuc' => true));
        }else{
            return response()->json(array('sonuc' => false));
        }
    }
}
