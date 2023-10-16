<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use App\Models\User;
use App\Notifications\ForgotPassword;

class UserResetPassword extends Controller
{
    use Notifiable;

    public function show()
    {
        return view('auth.user.reset-password');
    }

    public function routeNotificationForMail() {
        return request()->email;
    }

    public function send(Request $request)
    {
        $email = $request->validate([
            'email' => ['required']
        ]);
        $user = User::where('email', $email)->first();

        if ($user) {
            $this->notify(new ForgotPassword($user->id));
            return back()->with('succes', 'An email was send to your email address');
        }
    }
}
