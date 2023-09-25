<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

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
                            ->select('users.username', 'users.email', 'cellphone_boards.id', 'cellphone_boards.cpb_applicant', 'cellphone_boards.cpb_nationality', 'cellphone_boards.cpb_status', 'cellphone_boards.create_at')
                            ->paginate(10);
        } else {
            $cell_phones = DB::table('cellphone_boards')
                            ->join('users', 'cellphone_boards.u_id', '=' ,'users.id')
                            ->where('cellphone_boards.u_id', Auth::id())
                            ->select('users.username', 'users.email', 'cellphone_boards.id', 'cellphone_boards.cpb_applicant', 'cellphone_boards.cpb_nationality', 'cellphone_boards.cpb_status', 'cellphone_boards.create_at')
                            ->paginate(10);
        }

        if (view()->exists("pages.user.{$page}")) {
            return view("pages.user.{$page}", ['cell_phones' => $cell_phones]);
        }

        return abort(404);
    }

    public function register(string $page) {

        if (view()->exists("pages.user.{$page}_register")) {
            return view("pages.user.{$page}_register");
        }
    }

    public function register_insert(Request $request) {
        
        $user_id_check = DB::table('users')->where('id', Auth::id())->value('id');
        $user_name_check = DB::table('users')->where('id', Auth::id())->value('username');
        $currentDateTime = Carbon::now()->timezone('Asia/Seoul');
        $now_date_time = $currentDateTime->toDateTimeString();

        // Form validate 구성
        $validated = $request->validate([
            'applicant' => 'required',
            'nationality' => 'required',
            'passport' => 'required',
            'dateofbirth' => 'required',
            'gender' => 'required|in:male,female',
            'device' => 'required|in:apple,samsung,other',
            'devicemodel' => 'required',
            'osversion' => 'required',
            'imeinumber' => 'required',
            'plan' => 'required|in:ok',
            'signaturetxt' => 'required',
            'callservice' => 'required|in:yes,no',
            'service' => 'required|in:annual_agreement,monthly_plan',
            'connectivity' => 'required|in:4g,5g',
        ]);

        // PassPort Upload 구성
        $upload_file = $request->file('passport')->store('images/passport');
        if($upload_file) {
            $file_name = $request->file('passport')->getClientOriginalName();
            $random_explode = explode('images/passport/', $upload_file);
            $extension_cut = explode('.png', $random_explode[1]);
            $random_file_name = $extension_cut[0];

            $passport_insert_id = DB::table('passport_uploads')->insertGetId([
                'u_id' => $user_id_check,
                'ppu_filename' => $file_name,
                'ppu_encode_filename' => $random_file_name,
                'create_at' => $now_date_time
            ]);
        } else {
            return back()->with('error', 'The passport was not uploaded successfully.');
        }

        // Signature Upload 구성
        $base64_img = $request->post('signaturetxt');
        $base64_img = str_replace('data:image/png;base64,', '', $base64_img);
        $base64_img = str_replace(' ', '+', $base64_img);
        $base64_decoding_img = base64_decode($base64_img);
        $file_name = $user_name_check.time().'.png';
        $signatures = Storage::put('/images/signatures/'.$file_name, $base64_decoding_img);
        if($signatures) {
            $signature_insert_id = DB::table('signature_uploads')->insertGetId([
                'u_id' => $user_id_check,
                'stu_filename' => $file_name,
                'stu_base64' => $base64_img,
                'create_at' => $now_date_time
            ]);
        } else {
            return back()->with('error', 'The signature was not uploaded successfully.');
        }
        
        $applicant = $request->post('applicant');
        $nationality = $request->post('nationality');
        $dateofbirth = $request->post('dateofbirth');
        $gender = $request->post('gender');
        $device = $request->post('device');
        $devicemodel = $request->post('devicemodel');
        $osversion = $request->post('osversion');
        $imeinumber = $request->post('imeinumber');
        $plan = $request->post('plan');
        $callservice = $request->post('callservice');
        $service = $request->post('service');
        $connectivity = $request->post('connectivity');

        if($request->post('referral')) {
            $referral = $request->post('referral');
        } else {
            $referral = null;
        }

        if($request->post('chooselastnumber')) {
            $chooselastnumber = $request->post('chooselastnumber');
        } else {
            $chooselastnumber = null;
        }

        
        $cellphone_insert_id = DB::table('cellphone_boards')->insertGetId([
            'cpb_applicant' => $applicant,
            'cpb_nationality' => $nationality,
            'cpb_status' => 'opening',
            'u_id' => $user_id_check,
            'ppu_id' => $passport_insert_id,
            'cpb_dateofbirth' => $dateofbirth,
            'cpb_gender' => $gender,
            'cpb_device' => $device,
            'cpb_devicemodel' => $devicemodel,
            'cpb_osversion' => $osversion,
            'cpb_imeinumber' => $imeinumber,
            'cpb_plan' => $plan,
            'cpb_chooselastnumber' => $chooselastnumber,
            'stu_id' => $signature_insert_id,
            'cpb_referral' => $referral,
            'cpb_callservice' => $callservice,
            'cpb_service' => $service,
            'cpb_connectivity' => $connectivity,
            'cpb_telecoms' => 'kt',
            'create_at' => $now_date_time
        ]);

        if($cellphone_insert_id) {
            return redirect('/user/tables');
        } else {
            return back()->with('error', 'Cell phone opening registration failed.');
        }
    }

    public function modify(string $page, $num) {
        
        $board_check = DB::table('cellphone_boards')->where('u_id', Auth::id())->where('id', $num)->exists();
        if($board_check) {
            $cell_phones = DB::table('cellphone_boards')
                            ->join('signature_uploads', 'cellphone_boards.stu_id', '=' ,'signature_uploads.id')
                            ->join('passport_uploads', 'cellphone_boards.ppu_id', '=' ,'passport_uploads.id')
                            ->where('cellphone_boards.u_id', Auth::id())
                            ->where('cellphone_boards.id', $num)
                            ->first();

            if (view()->exists("pages.user.{$page}_modify")) {
                return view("pages.user.{$page}_modify", ['cell_phones' => $cell_phones]);
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
