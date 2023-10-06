<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $todayDate = Carbon::now()->timezone('Asia/Seoul')->format('Y-m-d');

        echo $todayDate;

        $user_cnt = DB::table('users')
                        ->where('created_at', 'like', $todayDate.'%')
                        ->count();
                        // ->toSql();

        $cellphone_cnt = DB::table('cellphone_boards')
                        ->where('created_at', 'like', "'".$todayDate."%'")
                        // ->count();
                        ->toSql();

        $cellphone_done_cnt = DB::table('cellphone_boards')
                        ->where('created_at', 'like', "'".$todayDate."%'")
                        ->where('cpb_status', 'closing')
                        // ->count();
                        ->toSql();

        $cellphone_not_cnt = DB::table('cellphone_boards')
                        ->where('created_at', 'like', "'".$todayDate."%'")
                        ->where('cpb_status', '<>', 'closing')
                        // ->count();
                        ->toSql();

        return view('pages.dashboard', compact('user_cnt', 'cellphone_cnt', 'cellphone_done_cnt', 'cellphone_not_cnt'));
    }
}
