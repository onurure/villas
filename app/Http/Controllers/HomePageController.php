<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use App\Property;
use App\Review;
// use View;

class HomePageController extends Controller
{
    // public function __construct(){
    //   $value1 = \Cache::remember('settings1', '1', function () {
    //       return Setting::all();
    //   });
    //   View::share('value', $value1);
    // }
    public function Index(){
        $vitrines = Property::where('vitrine',1)->inRandomOrder()->limit(12)->get();
        dd($vitrine);
        return view('homepage', compact('vitrines'));
    }
    public function Contact(){
        return view('contact');
    }
}
