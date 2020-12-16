<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Property;
use App\SubCategory;
use App\Setting;
use App\Translation;
use Auth;
use Carbon\Carbon;
use Cache;
use App\Review;
use App\Place;

class FrontEndController extends Controller
{
    public function __construct(){
        $setting = Setting::Find(1);
        if($setting->updated_at<Carbon::today()->toDateString()){
            $xml = simplexml_load_file('http://www.tcmb.gov.tr/kurlar/today.xml');
            foreach ($xml->Currency as $Currency) {
                if ($Currency['Kod'] == "USD") {
                    $usd_DS = $Currency->BanknoteSelling;
                }
                if ($Currency['Kod'] == "EUR") {
                    $eur_DS = $Currency->BanknoteSelling;
                }
                if ($Currency['Kod'] == "GBP") {
                    $gbp_DS = $Currency->BanknoteSelling;
                }
            }
            $setting->dolar = $usd_DS;
            $setting->euro = $eur_DS;
            $setting->gbp = $gbp_DS;
            $setting->save();
        }
        if(!session()->has('doviz')){
            session()->put('doviz', '1');
        }
        if(Cache::get('diller')){
            $diller = Translation::select('language','lan')->groupBy('lan')->get();
            Cache::put('diller',$diller,86400000);
        }else{
            $diller = Translation::select('language','lan')->groupBy('lan')->get();
            Cache::put('diller',$diller,86400000);
        }
    }
    public function Index(){
        $reviews = Review::inRandomOrder()->limit(3)->get();
        $vitrines = Property::where('vitrine',1)->where('approve',1)->inRandomOrder()->limit(12)->get();
        $places = Place::inRandomOrder()->limit(4)->get();
        return view('homepage', compact('vitrines','reviews','places'));
    }
    public function Contact(){
        return view('contact');
    }
    public function ContactMail(Request $req){
        \Mail::to("brooterreklamcilik@gmail.com ")->send(new \App\Mail\ContactForm($req));
        if(count(\Mail::failures()) > 0){
            $basari = 0;
        }else{
            $basari = 1;
        }
        return view('contact',compact('basari'));
    }
    public function SubCategory(Request $req){
        $mc = $req['mc'];
        $selectone = $req['selectone'];
        $subcategories = SubCategory::where('category_id','=',$req->mc)->get();
        $returnHTML = view('ajax',['islem' => 'subcategory','subcategories'=> $subcategories,'selectone'=>$selectone])->render();
        return response()->json( array('success' => true, 'html'=>$returnHTML) );
    }
    public function DilAyarla(Request $req)
    {
        session()->put('lang', $req['dil']);
        return response()->json(['success' => true]);
    }
}
