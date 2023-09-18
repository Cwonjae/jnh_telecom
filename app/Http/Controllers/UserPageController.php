<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserPageController extends Controller
{
    /**
     * Display all the static pages when authenticated
     *
     * @param string $page
     * @return \Illuminate\View\View
     */
    public function index(string $page)
    {
        $admin_email_checks = DB::table('users')->where('id', Auth::id())->value('email');

        /**
         * admin 일 경우 등록된 모든 정보 리스트업
         * 등록한사람(일반 user)일 경우 본인이 작성한 정보 리스트업
         */
        if($admin_email_checks == "admin@argon.com") {
            $cell_phones = DB::table('cellphone_boards')
                            ->join('users', 'cellphone_boards.u_id', '=' ,'users.id')
                            ->where('u_id', Auth::id())
                            ->select('users.username', 'users.email', 'cellphone_boards.cpb_applicant', 'cellphone_boards.cpb_nationality', 'cellphone_boards.cpb_status', 'cellphone_boards.create_at')
                            ->get();
        } else {
            $cell_phones = DB::table('cellphone_boards')
                            ->join('users', 'cellphone_boards.u_id', '=' ,'users.id')
                            ->select('users.username', 'users.email', 'cellphone_boards.cpb_applicant', 'cellphone_boards.cpb_nationality', 'cellphone_boards.cpb_status', 'cellphone_boards.create_at')
                            ->get();
        }

        if (view()->exists("pages.user.{$page}")) {


            return view("pages.user.{$page}", ['cell_phones' => $cell_phones]);
        }

        return abort(404);
    }

    public function vr()
    {
        return view("pages.virtual-reality");
    }

    public function rtl()
    {
        return view("pages.rtl");
    }

    public function profile()
    {
        return view("pages.profile-static");
    }

    public function signin()
    {
        return view("pages.sign-in-static");
    }

    public function signup()
    {
        return view("pages.sign-up-static");
    }
}
