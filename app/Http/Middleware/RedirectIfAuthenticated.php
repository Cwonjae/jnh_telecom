<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $urlArr = explode('/', $request->url());
                $res = end($urlArr);
                $urlArr_cnt = count($urlArr);
                $res_cnt_val = $urlArr[$urlArr_cnt-2];
                
                if($res == "user" || $res_cnt_val == "user") {
                    return redirect('/userhome');
                } else {
                    return redirect('/home');
                }
            }
        }

        return $next($request);
    }
}
