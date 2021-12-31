<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use Auth;
use Exception;
use App\Models\User;
use App\Models\UserSvg;
use Session;
use DB;

class SocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    
    public function handleGoogleCallback()
    { 
        
        try {            
            
            $user = Socialite::driver('google')->stateless()->user();
            $finduser = User::where('google_id', $user->id)->first();
            Auth::logout();
            if($finduser){
     
                Auth::login($finduser);
                if(!empty($finduser)){ 
                    $id = UserSvg::create([ 
                        'name' => Session::get('svg_name'), 
                        'file' => Session::get('svg'), 
                        'user_id' => $finduser->id 
                    ])->id;
                }
        
                $guest = Session::get('guest_id');
                if(!empty($guest)){
                    DB::table('users')->where('email',$guest)->delete();
                    Session::forget('lastActivityTime'); 
                    Session::forget('guest_id'); 
                    Session::forget('svg_name');
                    Session::forget('svg'); 
                    \Cookie::queue(\Cookie::forget('isGuest')); 
                }
                Auth::loginUsingId($finduser->id,true);  
                return redirect('/my-drawings');
     
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'sex' => "-",
                    'password' => '',
                    'role' => "student",
                    'email_verified_at' => date('Y-m-d h:i:s'), 
                    //'password' => encrypt('123456dummy')
                ]);

                if(!empty($newUser)){ 
                    $id = UserSvg::create([ 
                        'name' => Session::get('svg_name'), 
                        'file' => Session::get('svg'), 
                        'user_id' => $newUser->id 
                    ])->id;
                }
        
                $guest = Session::get('guest_id');
                if(!empty($guest)){
                    DB::table('users')->where('email',$guest)->delete();
                    Session::forget('lastActivityTime'); 
                    Session::forget('guest_id');  
                    Session::forget('svg_name');
                    Session::forget('svg');
                    \Cookie::queue(\Cookie::forget('isGuest')); 
                }
                Auth::loginUsingId($newUser->id,true);  
     
                return redirect('/my-drawings');
            }
    
        } catch (Exception $e) {
           
            dd($e->getMessage());
        }
    }


    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            $finduser = User::where('facebook_id', $user->id)->first();
            
            if($finduser){
     
                Auth::login($finduser);
                if(!empty($finduser)){ 
                    $id = UserSvg::create([ 
                        'name' => Session::get('svg_name'), 
                        'file' => Session::get('svg'), 
                        'user_id' => $finduser->id 
                    ])->id;
                }
        
                $guest = Session::get('guest_id');
                if(!empty($guest)){
                    DB::table('users')->where('email',$guest)->delete();
                    Session::forget('lastActivityTime'); 
                    Session::forget('guest_id'); 
                    Session::forget('svg_name');
                    Session::forget('svg'); 
                    \Cookie::queue(\Cookie::forget('isGuest')); 
                }
                return redirect('/my-drawings');
     
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'facebook_id'=> $user->id,
                    'sex' => "-",
                    'password' => '',
                    'role' => "student",
                    'email_verified_at' => date('Y-m-d h:i:s'), 
                ]);
                if(!empty($newUser)){ 
                    $id = UserSvg::create([ 
                        'name' => Session::get('svg_name'), 
                        'file' => Session::get('svg'), 
                        'user_id' => $newUser->id 
                    ])->id;
                }
        
                $guest = Session::get('guest_id');
                if(!empty($guest)){
                    DB::table('users')->where('email',$guest)->delete();
                    Session::forget('lastActivityTime'); 
                    Session::forget('guest_id');  
                    Session::forget('svg_name');
                    Session::forget('svg');
                    \Cookie::queue(\Cookie::forget('isGuest')); 
                }
                Auth::login($newUser);
     
                return redirect('/my-drawings');
            }


        } catch (Exception $e) {


            return redirect('auth/facebook');


        }
    }
}
