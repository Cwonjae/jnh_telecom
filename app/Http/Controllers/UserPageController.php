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
                            ->select('users.username', 'users.email', 'cellphone_boards.cpb_applicant', 'cellphone_boards.cpb_nationality', 'cellphone_boards.cpb_status', 'cellphone_boards.create_at')
                            ->paginate(10);
        } else {
            $cell_phones = DB::table('cellphone_boards')
                            ->join('users', 'cellphone_boards.u_id', '=' ,'users.id')
                            ->where('u_id', Auth::id())
                            ->select('users.username', 'users.email', 'cellphone_boards.cpb_applicant', 'cellphone_boards.cpb_nationality', 'cellphone_boards.cpb_status', 'cellphone_boards.create_at')
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
        // $validated = $request->validate([
        //     'applicant' => 'required',
        //     'nationality' => 'required',
        //     'passport' => 'required',
        //     'dateofbirth' => 'required',
        //     'gander' => 'required|in:male,female',
        //     'device' => 'required|in:apple,samsung,other',
        //     'devicemodel' => 'required',
        //     'osversion' => 'required',
        //     'imeinumber' => 'required',
        //     'plan' => 'required|in:ok',
        //     'callservice' => 'required|in:yes,no',
        //     'service' => 'required|in:annual_agreement,monthly_plan',
        //     'connectivity' => 'required|in:4g,5g',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json(['error' => $validator->errors()->all()]);
        // }

        // $all_data = $request->post();
        // echo print_r($all_data);

        // PassPort Upload 구성
        // $upload_file = $request->file('passport')->store('images/passport');

        // if($upload_file) {
        //     $file_name = $request->file('passport')->getClientOriginalName();
        //     $random_explode = explode('images/passport/', $upload_file);
        //     $extension_cut = explode('.png', $random_explode[1]);
        //     $random_file_name = $extension_cut[0];

        //     DB::table('passport_uploads')->insert([
        //         'u_id' => $user_id_check,
        //         'ppu_filename' => $file_name,
        //         'ppu_encode_filename' => $random_file_name,
        //         'create_at' => $now_date_time
        //     ]);
        // }

        $base64_img = $request->post('signaturetxt');
        echo $base64_img;
        $base64_img = str_replace('data:image/png;base64,', '', $base64_img);
        $base64_img = str_replace(' ', '+', $img);
        $base64_decoding_img = base64_decode($base64_img);
        $file = $user_name_check.time().'.png';

        Storage::disk('signatures')->put($file, $base64_decoding_img);
        // $all_data = $request->post();
        // echo print_r($all_data);



        // DB::table('cellphone_boards')
        //     ->()        
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
