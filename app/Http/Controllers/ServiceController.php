<?php

namespace App\Http\Controllers;

use Mail;
use Illuminate\Http\Request;
use App\Service;
use App\Simage;
use App\Category;
use Illuminate\Support\Facades\Input;
use Auth;

class ServiceController extends Controller
{
    public function Index(){
        $services = Service::where('firm_id',Auth::guard('firm')->id())->orderBy('created_at', 'DESC')->paginate(20);
        return view('user.my-services', compact('services'));
    }
    public function Edit($p_id="")
    {
    	if($p_id==""){
			$service = new Service;
		}else{
			$service = Service::Find($p_id);
		}
        $categories = Category::all();
		return view('user.service', compact('service','categories'));
    }
    public function Save(Request $req, $p_id="")
    {
    	if($p_id==""){
			$service = new Service;
            $service = $req->except(['images','featured','category','subcategory']);
            $service['category_id'] = $req['category'];
            $service['sub_category_id'] = $req['subcategory'];
            //$service['expiration_at'] = Carbon::now()->addDays(30);
            $new_service = Auth::guard('firm')->firm()->services()->create($service);
            $image = new Simage();
            $image['vitrine'] = $req['featured'];
            $image['image_links'] = json_encode($req['images']);
            $new_service->simage()->save($image);
		}else{
            $service = Service::Find($p_id);
            if(Auth::guard('firm')->id()==$service->firm_id){
                $service->fill($req->except(['images','featured','category','subcategory']));
                $service->approve = 0;
                $service['category_id'] = $req['category'];
                $service['sub_category_id'] = $req['subcategory'];
                $service->save();
                if($service->simage){
                    $image = $service->simage;
                }else{
                    $image = new Simage();
                }
                $image['vitrine'] = $req['featured'];
                $image['image_links'] = json_encode($req['images']);
                $service->simage()->save($image);
            }
		}
        return redirect('user/my-services');
    }
    public function Services(Request $req){
        $properties = Service::where('approve', 1);
        if(isset($req['kw']) and $req['kw']!=""){
            $properties = $properties->where(function ($query) use ($req){
                $query->where('title', 'LIKE', '%' . $req['kw'] . '%')
                      ->orWhere('city', 'LIKE', '%' . $req['kw'] . '%')
                      ->orWhere('district', 'LIKE', '%' . $req['kw'] . '%');
            });
        }
        if(isset($req['cat'])&&$req['cat']!=""){
            $properties = $properties->where('category_id','=',$req['cat']);
        }
        if(isset($req['subcategory'])&&$req['subcategory']!=""){
            $properties = $properties->where('sub_category_id','=',$req['subcategory']);
        }
        $services = $properties->orderBy('created_at', 'DESC')->paginate(10);
        $categories = Category::all();
        return view('services', compact('services','categories'));
	}
    public function Service($v_id){
        $property = Service::find($v_id);
        if($property->approve==1){
            //$property->views = $property->views+1;
            //$property->save();
            return view('service', compact('property'));
        }else{
            if(Auth::guard('firm')->id()==$property->firm_id){
                return view('service', compact('property'));
            }else{
                return back();
            }
        }
    }
    public function ServiceMail(Request $req, $v_id){
        $property = Service::find($v_id);
        Mail::to($property->firm->email)->send(new \App\Mail\ServiceMail($property,$req));
        if(count(Mail::failures()) > 0){
            $basari = 0;
        }else{
            $basari = 1;
        }
        return view('service', compact('property','basari'));
    }
}
