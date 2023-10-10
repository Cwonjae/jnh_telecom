<?php

namespace App\Http\Controllers;

// use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserVerify;
use Session;
use Hash;
use Illuminate\Support\Str;
use Mail; 
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class UserRegisterController extends Controller
{
    public function create()
    {
        return view('auth.user.register');
    }

    public function store()
    {
        $attributes = request()->validate([
            'username' => 'required|max:255|min:2',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:5|max:255',
            'terms' => 'required'
        ]);
        $user = User::create($attributes);
        auth()->login($user);

        return redirect('/user/dashboard');
    }

    public function registration(Request $request) {
        $attributes = request()->validate([
            'username' => 'required|max:255|min:2',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:5|max:255',
            'terms' => 'required'
        ]);
        $user = User::create($attributes);
  
        $token = Str::random(64);
  
        UserVerify::create([
              'user_id' => $user->id, 
              'token' => $token
            ]);
  
        Mail::send('auth.user.verify-email', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Verify Email Addresses');
          });
         
        Alert::warning('Verify Email Addresses', 'You can login after checking your email');
        return redirect("/user/login")->withErrors([
            'verify' => 'You can login after checking your email',
        ]);
    }

    public function verifyAccount($token) {
        $currentDateTime = Carbon::now();
        $now_date_time = $currentDateTime->toDateTimeString();
        $verifyUser = UserVerify::where('token', $token)->first();
  
        if(!is_null($verifyUser) ){
            $user = $verifyUser->user;
              
            if(!$user->email_verified_at) {
                $verifyUser->user->email_verified_at = $now_date_time;
                $verifyUser->user->save();
                
                $message = "Your email is verified. You can now login.";
                Alert::success('Verify Email Addresses', $message);
                return redirect()->route('userlogin')->with('message', $message);
            } else {
                $message = "Your email is already verified. You can now login.";
                Alert::error('Verify Email Addresses', $message);
                return redirect()->route('userlogin')->with('message', $message);
            }
        } else {
            $message = 'Sorry your email cannot be identified.';
            Alert::warning('Verify Email Addresses', $message);
            return redirect()->route('userlogin')->with('message', $message);

        }
    }
}
