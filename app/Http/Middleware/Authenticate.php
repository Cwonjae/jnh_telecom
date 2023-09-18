<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            // $urlArr = explode('/', $request->url());
            // $res = end($urlArr);
            // $urlArr_cnt = count($urlArr);
            // $res_cnt_val = $urlArr[$urlArr_cnt-2];
            
            // if($res == "user" || $res_cnt_val == "user") {
            //     return route('userlogin');
            // } else {
            //     return route('login');
            // }

            if($request->is('user/*')) {
                return route('userlogin');
            } else {
                return route('login');
            }
        }
    }
}
