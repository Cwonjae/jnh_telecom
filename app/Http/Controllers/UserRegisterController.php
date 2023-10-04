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
        $request->validate([
            'username' => 'required|max:255|min:2',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:5|max:255',
        ]);
           
        $data = $request->post();
        $createUser = $this->create($data);
  
        $token = Str::random(64);
  
        UserVerify::create([
              'user_id' => $createUser->id, 
              'token' => $token
            ]);
  
        Mail::send('auth.uesr.verify-email', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Email Verification Mail');
          });
         
        return redirect("/user/dashboard")->withSuccess('Great! You have Successfully loggedin');
    }

    public function verifyAccount($token) {
        $verifyUser = UserVerify::where('token', $token)->first();
  
        $message = 'Sorry your email cannot be identified.';
  
        if(!is_null($verifyUser) ){
            $user = $verifyUser->user;
              
            if(!$user->email_verified_at) {
                $verifyUser->user->email_verified_at = 1;
                $verifyUser->user->save();
                $message = "Your email is verified. You can now login.";
            } else {
                $message = "Your email is already verified. You can now login.";
            }
        }
  
        return redirect()->route('login')->with('message', $message);
    }
}
