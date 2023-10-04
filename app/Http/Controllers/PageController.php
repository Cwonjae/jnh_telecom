<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PageController extends Controller
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
                            ->where('cellphone_boards.cpb_telecoms', 'kt')
                            ->select('users.username', 'users.email', 'cellphone_boards.id', 'cellphone_boards.cpb_applicant', 'cellphone_boards.cpb_nationality', 'cellphone_boards.cpb_status', 'cellphone_boards.cpb_telecoms', 'cellphone_boards.created_at')
                            ->paginate(10);
        } else {
            return abort(404);
        }

        if (view()->exists("pages.{$page}")) {
            return view("pages.{$page}", ['cell_phones' => $cell_phones]);
        }

        return abort(404);
    }

    public function print(string $page, $num) {        
        $board_check = DB::table('cellphone_boards')->where('u_id', Auth::id())->where('id', $num)->exists();
        if($board_check) {
            $cell_phones = DB::table('cellphone_boards')
                            ->join('signature_uploads', 'cellphone_boards.stu_id', '=' ,'signature_uploads.id')
                            ->join('passport_uploads', 'cellphone_boards.ppu_id', '=' ,'passport_uploads.id')
                            ->where('cellphone_boards.id', $num)
                            ->select('cellphone_boards.*', 'signature_uploads.stu_filename', 'signature_uploads.stu_base64', 'passport_uploads.ppu_filename', 'passport_uploads.ppu_encode_filename')
                            ->get();

            if (view()->exists("pages.user.{$page}_print")) {
                return view("pages.user.{$page}_print", ['cell_phones' => $cell_phones]);
            }
        } else {
            return abort(404);
        }

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
