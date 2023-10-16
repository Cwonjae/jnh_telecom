<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    /**
     * Display login page.
     *
     * @return Renderable
     */
    public function show()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $admin_checks = DB::table('users')
                            ->where('email', $request->email)
                            ->where('grade', 'admin')
                            ->count();

        if($admin_checks > 0) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $request->session()->regenerate();
    
                // return redirect()->intended('dashboard');
                return redirect('/admin/dashboard');
            }
        } else {
            Alert::error('Login Fail', 'This account is not an Admin account. Please use the admin account');
            return back()->withErrors([
                'email' => 'This account is not an Admin account. Please use the admin account',
            ]);

        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
