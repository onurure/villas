<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Favorite;
use App\Property;
use App\PasswordReset;
use Auth;
use Hash;
use Mail;

class UserController extends Controller
{
    public function Login(){
        return view('login');
    }
    public function Signin(){
        return view('signin');
    }
    public function Logout(){
        Auth::logout();
        return redirect('/');
    }
    public function LogoutF(){
        Auth::guard('firm')->logout();
        return redirect('/');
    }
    public function LoginPost(Request $req){
        if(isset($req['register'])&&$req['register'] == "Register"){
            $this->validate($req, [
                'email2' => 'required|email|unique:users,email',
                'username2' =>  'required|min:3',
                'password1' =>  'required|min:4',
                'password2' =>  'required|same:password1'
            ]);
            $user = new User();
            $user['name'] = $req['username2'];
            $user['email'] = $req['email2'];
            $user['password'] = bcrypt($req['password1']);
            $user['mailtoken']  = str_random(25);
            $user->save();
            Mail::to($user)->send(new \App\Mail\NewUserConfirmation($user));
  			//Auth::login($user);
            return redirect('confirmation')->withErrors(['Hata' => 'Hesabınızı onaylamak için size bir onay maili gönderdik. Lütfen mail adresinizi kontrol edin.']);
        }else if(isset($req['login'])&&$req['login']=="Login"){
            if(Auth::attempt(['email' => $req['email'], 'password' => $req['password']])){
                if(Auth::user()->confirmation==0){
                    Auth::logout();
                    return redirect('confirmation')->withErrors(['Hata' => 'Kullandığınız mail adresi onaylanmamıştır. Lütfen mail adresinizi kontrol edin ya da yeni bir onay kodu almak için tıklayın.']);
                }else{
                    return redirect("user/account");
                }
            }else{
                return redirect()->back()->withErrors(['Hata'=>'Mail adresiniz ya da şifreniz hatalı.']);
            }
        }else if(isset($req['firmlogin'])&&$req['firmlogin']=="Firm Login"){
            if(Auth::guard('firm')->attempt(['firmcode' => $req['firmcode'], 'password' => $req['password']])){
                return redirect("user/my-services");
            }else{
                return redirect()->back()->withErrors(['Hata'=>'Mail adresiniz ya da şifreniz hatalı.']);
            }
        }
    }
    public function SigninPost(Request $req){
        if(isset($req['register'])&&$req['register'] == "Register"){
            $this->validate($req, [
                'email2' => 'required|email|unique:users,email',
                'username2' =>  'required|min:3',
                'password1' =>  'required|min:4',
                'password2' =>  'required|same:password1'
            ]);
            $user = new User();
            $user['name'] = $req['username2'];
            $user['email'] = $req['email2'];
            $user['password'] = bcrypt($req['password1']);
            $user['mailtoken']  = str_random(25);
            $user->save();
            Mail::to($user)->send(new \App\Mail\NewUserConfirmation($user));
  			//Auth::login($user);
            return redirect('confirmation')->withErrors(['Hata' => 'Hesabınızı onaylamak için size bir onay maili gönderdik. Lütfen mail adresinizi kontrol edin.']);
        }else if(isset($req['register'])&&$req['register'] == "Register2"){
            //dd($req['sirket']);
            $this->validate($req, [
                'email2' => 'required|email|unique:users,email',
                'username2' =>  'required|min:3',
                'password1' =>  'required|min:4',
                'password2' =>  'required|same:password1',
                'sirket'    =>  'required',
                'ticari'    =>  'required',
                'vergid'    =>  'required',
                'vergino'   =>  'required'
            ]);
            $user = new User();
            $user['name'] = $req['username2'];
            $user['email'] = $req['email2'];
            $user['password'] = bcrypt($req['password1']);
            $user['mailtoken']  = str_random(25);
            $user['sirket'] = $req['sirket'];
            $user['ticari'] = $req['ticari'];
            $user['vergid'] = $req['vergid'];
            $user['vergino'] = $req['vergino'];
            $user->save();
            Mail::to($user)->send(new \App\Mail\NewUserConfirmation($user));
  			//Auth::login($user);
            return redirect('confirmation')->withErrors(['Hata' => 'Hesabınızı onaylamak için size bir onay maili gönderdik. Lütfen mail adresinizi kontrol edin.']);
        }
    }
    public function Lost(){
        return view('lost');
    }
    public function LostSend(Request $req){
		$this->validate($req, [
			'email' =>  'required|email',
		]);
        $find = User::where('email','=',$req['email'])->first();
        $pass = new PasswordReset();
        $pass->email = $find->email;
        $pass->token = str_random(25);
        $pass->created_at = new \DateTime();
        $pass->save();
        Mail::to($find)->send(new \App\Mail\UserForget($pass));
        return view('lost');
    }
    public function OnayLink(){
        return view('confirmation');
    }
    public function OnayLinkG(Request $req){
		$this->validate($req, [
			'email' =>  'required|email',
		]);
        $user = User::where('email','=',$req['email'])->first();
        if($user->confirmation==0 && $user->mailtoken!="" ){
            Mail::to($user)->send(new \App\Mail\NewUserConfirmation($user));
            return view('confirmation')->withErrors(['Hata' => 'Hesabınızı onaylamak için size bir onay maili gönderdik. Lütfen mail adresinizi kontrol edin.']);
        }else{
            return redirect()->back()->withErrors(['Hata' => 'Hesabınız aktif görünüyor.']);
        }
    }
    public function PassReset($token)
    {
        return view('reset',compact('token'));
    }
    public function PassResetS(Request $req,$token)
    {
        $this->validate($req, [
            'email' => 'required|email',
            'passw1' =>  'required|min:4',
            'passw1' =>  'required|same:passw1'
        ]);
        $pass = PasswordReset::where('email','=',$req['email'])->first();
        if($pass->token==$token ){
            $user = User::where('email','=',$req['email'])->first();
            $user['password'] = bcrypt($req['passw1']);
            $user->save();
            Auth::login($user);
        }else{
            return redirect()->back()->withErrors(['Hata' => 'Bir hata oluştu.']);
        }
        return redirect("user/account");
    }
	public function Password(){
		return view('user.change-password');
	}
	public function PasswordPost(Request $req){
		$this->validate($req, [
			'password' =>  'required|min:4',
			'password1' =>  'required|min:4',
			'password2' =>  'required|same:password1'
		]);
		$user = User::find(Auth::id());
		if(Hash::check($req['password'], $user['password'])){
			$user['password'] = bcrypt($req['password1']);
			$user->save();
			return back()->with('success', 'Password changed successfully.');
		}else{
			return back()->withErrors(['Current Password can not be match.']);
		}
	}
    public function Account(){
		$user = User::find(Auth::id());
		return view('user.account', compact('user'));
	}
    public function AccountSave(Request $req){
		$user = User::find(Auth::id());
        $user->fill($req->all());
        $user->save();
		return view('user.account', compact('user'));
	}
    public function FavoriteAdd(Request $req){
        $p_id = $req['pr_id'];
        $favorite = Favorite::where('user_id', Auth::id())->first();
        if(count($favorite)>0){
            $fav_id = json_decode($favorite['property_ids']);
        }else{
            $favorite = new Favorite();
            $fav_id = array();
        }
        $fav_id[] = $p_id;
        $favorite->property_ids = json_encode($fav_id);
        Auth::user()->favorite()->save($favorite);
        $property = Property::find($p_id);
        $property->favorites = $property->favorites+1;
        $property->save();
        return response()->json(array('sonuc' => true));
    }
    public function FavoriteRemove(Request $req){
        $p_id = $req['pr_id'];
        $favorite = Favorite::where('user_id', Auth::id())->first();
        $fav_id = json_decode($favorite['property_ids']);
        $yeri = array_search($p_id,$fav_id);
        unset($fav_id[$yeri]);
        //dd(json_encode($fav_id));
        $favorite->property_ids = json_encode($fav_id);
        Auth::user()->favorite()->save($favorite);
        $property = Property::find($p_id);
        $property->favorites = $property->favorites-1;
        $property->save();
        return response()->json(array('sonuc' => true));
    }
    public function Onayla($userid,$token)
    {
        $user = User::Find($userid);
        if(!is_null($user)){
            if($user->mailtoken==$token){
                $user->confirmation = 1;
                $user->mailtoken = "";
                $user->save();
                return redirect('login');
            }
        }
    }
}
