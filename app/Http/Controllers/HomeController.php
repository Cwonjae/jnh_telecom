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
        $subdays = Carbon::now()->subDays(1)->timezone('Asia/Seoul')->format('Y-m-d');
        $nowYear = Carbon::now()->timezone('Asia/Seoul')->format('Y');
        $nowMonth = Carbon::now()->timezone('Asia/Seoul')->format('m');

        $user_cnt = DB::table('users')
                        ->where('created_at', 'like', $todayDate.'%')
                        ->count();

        $user_y_cnt = DB::table('users')
                        ->where('created_at', 'like', $subdays.'%')
                        ->count();

        $cellphone_cnt = DB::table('cellphone_boards')
                        ->where('created_at', 'like', $todayDate.'%')
                        ->count();

        $cellphone_y_cnt = DB::table('cellphone_boards')
                        ->where('created_at', 'like', $subdays.'%')
                        ->count();

        $cellphone_done_cnt = DB::table('cellphone_boards')
                        ->where('created_at', 'like', $todayDate.'%')
                        ->where('cpb_status', 'closing')
                        ->count();

        $cellphone_y_done_cnt = DB::table('cellphone_boards')
                        ->where('created_at', 'like', $subdays.'%')
                        ->where('cpb_status', 'closing')
                        ->count();

        $cellphone_not_cnt = DB::table('cellphone_boards')
                        ->where('created_at', 'like', $todayDate.'%')
                        ->where('cpb_status', '<>', 'closing')
                        ->count();

        $cellphone_y_not_cnt = DB::table('cellphone_boards')
                        ->where('created_at', 'like', $subdays.'%')
                        ->where('cpb_status', '<>', 'closing')
                        ->count();

        //두개의 값이 0일경우
        if($user_y_cnt != 0) {
            $yester_user_check = (($user_cnt - $user_y_cnt) / $user_y_cnt) * 100;
            if($user_cnt >= $user_y_cnt) {
                $yester_user_check = ($user_cnt / $user_y_cnt) * 100;
            }
        } else {
            $yester_user_check = $user_cnt * 100;
        }

        if($cellphone_y_cnt != 0) {
            $yester_cellphone_check = (($cellphone_cnt - $cellphone_y_cnt) / $cellphone_y_cnt) * 100;
            if($cellphone_cnt >= $cellphone_y_cnt) {
                $yester_cellphone_check = ($cellphone_cnt / $cellphone_y_cnt) * 100;
            }
        } else {
            $yester_cellphone_check = $cellphone_cnt * 100;
        }

        if($cellphone_y_done_cnt != 0) {
            $yester_cellphone_done_check = (($cellphone_done_cnt - $cellphone_y_done_cnt) / $cellphone_y_done_cnt) * 100;
            if($cellphone_done_cnt >= $cellphone_y_done_cnt) {
                $yester_cellphone_done_check = ($cellphone_done_cnt / $cellphone_y_done_cnt) * 100;
            }
        } else {
            $yester_cellphone_done_check = $cellphone_done_cnt * 100;
        }

        if($cellphone_y_not_cnt != 0) {
            $yester_cellphone_not_check = (($cellphone_not_cnt - $cellphone_y_not_cnt) / $cellphone_y_not_cnt) * 100;
            if($cellphone_not_cnt >= $cellphone_y_not_cnt) {
                $yester_cellphone_not_check = ($cellphone_not_cnt / $cellphone_y_not_cnt) * 100;
            }
        } else {
            $yester_cellphone_not_check = $cellphone_not_cnt * 100;
        }

        $nowYear_user_cnts = DB::table('users')
                                ->select(DB::raw('(select count(*) as cnt1 from users where created_at like "'.$nowYear.'-01%") as jan, (select count(*) as cnt1 from users where created_at like "'.$nowYear.'-02%") as feb, (select count(*) as cnt1 from users where created_at like "'.$nowYear.'-03%") as mar, (select count(*) as cnt1 from users where created_at like "'.$nowYear.'-04%") as apr, (select count(*) as cnt1 from users where created_at like "'.$nowYear.'-05%") as may, (select count(*) as cnt1 from users where created_at like "'.$nowYear.'-06%") as jun, (select count(*) as cnt1 from users where created_at like "'.$nowYear.'-07%") as jul, (select count(*) as cnt1 from users where created_at like "'.$nowYear.'-08%") as aug, (select count(*) as cnt1 from users where created_at like "'.$nowYear.'-09%") as sep, (select count(*) as cnt1 from users where created_at like "'.$nowYear.'-10%") as oct, (select count(*) as cnt1 from users where created_at like "'.$nowYear.'-11%") as nov, (select count(*) as cnt1 from users where created_at like "'.$nowYear.'-12%") as decc'))
                                ->where('created_at', 'like', $nowYear.'%')
                                ->first();

        $nowYear_cellphone_cnts = DB::table('cellphone_boards')
                                    ->select(DB::raw('(select count(*) as cnt1 from cellphone_boards where created_at like "'.$nowYear.'-01%") as jan, (select count(*) as cnt1 from cellphone_boards where created_at like "'.$nowYear.'-02%") as feb, (select count(*) as cnt1 from cellphone_boards where created_at like "'.$nowYear.'-03%") as mar, (select count(*) as cnt1 from cellphone_boards where created_at like "'.$nowYear.'-04%") as apr, (select count(*) as cnt1 from cellphone_boards where created_at like "'.$nowYear.'-05%") as may, (select count(*) as cnt1 from cellphone_boards where created_at like "'.$nowYear.'-06%") as jun, (select count(*) as cnt1 from cellphone_boards where created_at like "'.$nowYear.'-07%") as jul, (select count(*) as cnt1 from cellphone_boards where created_at like "'.$nowYear.'-08%") as aug, (select count(*) as cnt1 from cellphone_boards where created_at like "'.$nowYear.'-09%") as sep, (select count(*) as cnt1 from cellphone_boards where created_at like "'.$nowYear.'-10%") as oct, (select count(*) as cnt1 from cellphone_boards where created_at like "'.$nowYear.'-11%") as nov, (select count(*) as cnt1 from cellphone_boards where created_at like "'.$nowYear.'-12%") as decc'))
                                    ->where('created_at', 'like', $nowYear.'%')
                                    ->first();

        $nowYear_cellphone_done_cnts = DB::table('cellphone_boards')
                                    ->select(DB::raw('(select count(*) as cnt1 from cellphone_boards where created_at like "'.$nowYear.'-01%" and cpb_status = "closing") as jan, (select count(*) as cnt1 from cellphone_boards where created_at like "'.$nowYear.'-02%" and cpb_status = "closing") as feb, (select count(*) as cnt1 from cellphone_boards where created_at like "'.$nowYear.'-03%" and cpb_status = "closing") as mar, (select count(*) as cnt1 from cellphone_boards where created_at like "'.$nowYear.'-04%" and cpb_status = "closing") as apr, (select count(*) as cnt1 from cellphone_boards where created_at like "'.$nowYear.'-05%" and cpb_status = "closing") as may, (select count(*) as cnt1 from cellphone_boards where created_at like "'.$nowYear.'-06%" and cpb_status = "closing") as jun, (select count(*) as cnt1 from cellphone_boards where created_at like "'.$nowYear.'-07%" and cpb_status = "closing") as jul, (select count(*) as cnt1 from cellphone_boards where created_at like "'.$nowYear.'-08%" and cpb_status = "closing") as aug, (select count(*) as cnt1 from cellphone_boards where created_at like "'.$nowYear.'-09%" and cpb_status = "closing") as sep, (select count(*) as cnt1 from cellphone_boards where created_at like "'.$nowYear.'-10%" and cpb_status = "closing") as oct, (select count(*) as cnt1 from cellphone_boards where created_at like "'.$nowYear.'-11%" and cpb_status = "closing") as nov, (select count(*) as cnt1 from cellphone_boards where created_at like "'.$nowYear.'-12%" and cpb_status = "closing") as decc'))
                                    ->where('created_at', 'like', $nowYear.'%')
                                    ->first();

        return view('pages.dashboard', compact('user_cnt', 'user_y_cnt', 'cellphone_cnt', 'cellphone_y_cnt', 'cellphone_done_cnt', 'cellphone_y_done_cnt', 'cellphone_not_cnt', 'cellphone_y_not_cnt', 'yester_user_check', 'yester_cellphone_check', 'yester_cellphone_done_check', 'yester_cellphone_not_check', 'nowYear_user_cnts', 'nowYear_cellphone_cnts', 'nowYear_cellphone_done_cnts', 'nowYear'));
    }
}
