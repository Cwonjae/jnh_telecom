<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Mail;

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
        $admin_checks = DB::table('users')
                            ->where('id', Auth::id())
                            ->where('grade', 'admin')
                            ->count();

        /**
         * page = tables(선불제가입), posts(후불제가입)
         */
        if($page == "tables") {
            $where_add = "prepaid";
        } else {
            $where_add = "postpaid";
        }
        
        /**
         * admin 일 경우 등록된 모든 정보 리스트업
         * 등록한사람(일반 user)일 경우 본인이 작성한 정보 리스트업
         */
        if($admin_checks > 0) {
            $cell_phones = DB::table('cellphone_boards')
                            ->join('users', 'cellphone_boards.u_id', '=' ,'users.id')
                            ->select('users.username', 'users.email', 'cellphone_boards.id', 'cellphone_boards.cpb_applicant', 'cellphone_boards.cpb_nationality', 'cellphone_boards.cpb_status', 'cellphone_boards.cpb_after_status', 'cellphone_boards.created_at')
                            ->paginate(10);
        } else {
            $cell_phones = DB::table('cellphone_boards')
                            ->join('users', 'cellphone_boards.u_id', '=' ,'users.id')
                            ->join('idcard_check_mails', 'cellphone_boards.id', '=', 'idcard_check_mails.cpb_id')
                            ->where('cellphone_boards.u_id', Auth::id())
                            ->where('cellphone_boards.cpb_board_type', $where_add)
                            ->select('users.username', 'users.email', 'cellphone_boards.id', 'cellphone_boards.cpb_applicant', 'cellphone_boards.cpb_nationality', 'cellphone_boards.cpb_status', 'cellphone_boards.cpb_after_status', 'cellphone_boards.created_at', 'idcard_check_mails.id as iccm_id')
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
            'passportnumber' => 'required',
            'dateofbirth' => 'required',
            'gender' => 'required|in:male,female',
            // 'device' => 'required|in:apple,samsung,other',
            // 'devicemodel' => 'required',
            // 'osversion' => 'required',
            'imeinumber' => 'required',
            'plan' => 'required|in:ok',
            'signaturetxt' => 'required',
            // 'callservice' => 'required|in:yes,no',
            'service' => 'required|in:annual_agreement,monthly_plan',
            'connectivity' => 'required|in:4g,5g',
        ]);

        // PassPort Upload 구성
        // $upload_file = $request->file('passport')->store('public/images/passport');
        $upload_file = Storage::putFile('/public/images/passport',$request->file('passport'));
        if($upload_file) {
            $file_name = $request->file('passport')->getClientOriginalName();
            $random_explode = explode('public/images/passport/', $upload_file);
            $extension_cut = explode('.', $random_explode[1]);
            $random_file_name = $extension_cut[0];

            $passport_insert_id = DB::table('passport_uploads')->insertGetId([
                'u_id' => $user_id_check,
                'ppu_filename' => $file_name,
                'ppu_encode_filename' => $random_file_name,
                'created_at' => $now_date_time
            ]);
        } else {
            Alert::error('Passport Was Not Uploaded', 'The passport was not uploaded successfully [6]');
            return back()->with('error', 'The passport was not uploaded successfully.');
        }

        // Signature Upload 구성
        $base64_img = $request->post('signaturetxt');
        $base64_img = str_replace('data:image/png;base64,', '', $base64_img);
        $base64_img = str_replace(' ', '+', $base64_img);
        $base64_decoding_img = base64_decode($base64_img);
        $file_name = $user_name_check.time().'.png';
        $signatures = Storage::put('/public/images/signatures/'.$file_name, $base64_decoding_img);
        if($signatures) {
            $signature_insert_id = DB::table('signature_uploads')->insertGetId([
                'u_id' => $user_id_check,
                'stu_filename' => $file_name,
                'stu_base64' => $base64_img,
                'created_at' => $now_date_time
            ]);
        } else {
            Alert::error('Signature Was Not Uploaded', 'The signature was not uploaded successfully [5]');
            return back()->with('error', 'The signature was not uploaded successfully.');
        }
        
        $applicant = $request->post('applicant');
        $nationality = $request->post('nationality');
        $dateofbirth = $request->post('dateofbirth');
        $passport_number = $request->post('passportnumber');
        $gender = $request->post('gender');
        // $device = $request->post('device');
        // $devicemodel = $request->post('devicemodel');
        // $osversion = $request->post('osversion');
        $imeinumber = $request->post('imeinumber');
        $plan = $request->post('plan');
        // $callservice = $request->post('callservice');
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
            'cpb_passportnumber' => $passport_number,
            'ppu_id' => $passport_insert_id,
            'cpb_dateofbirth' => $dateofbirth,
            'cpb_gender' => $gender,
            // 'cpb_device' => $device,
            // 'cpb_devicemodel' => $devicemodel,
            // 'cpb_osversion' => $osversion,
            'cpb_imeinumber' => $imeinumber,
            'cpb_plan' => $plan,
            'cpb_chooselastnumber' => $chooselastnumber,
            'stu_id' => $signature_insert_id,
            'cpb_referral' => $referral,
            // 'cpb_callservice' => $callservice,
            'cpb_service' => $service,
            'cpb_connectivity' => $connectivity,
            'cpb_telecoms' => 'kt',
            'created_at' => $now_date_time
        ]);
        
        /**
         * 현재는 하드코딩으로 작성된 메일로 발송되게 함
         * 발송될 계정은 진앤현에서 갖고있는 계정으로
         * 해당 계정에 메일이 수신되면, 자동으로 관계자들의 계정으로 전달 예정
         */
        Mail::send('mobileForm.admin.form', ['tables' => 'tables'], function($message) use($request, $applicant){
              $message->to('kt.foreigner@jinnhyun.com');
              $message->subject('신규 선불제 모바일 신청이 등록되었습니다._'.$applicant);
          });

        if($cellphone_insert_id) {
            $passport_comparison_insert_id = DB::table('passport_comparison')->insertGetId([
                'cpb_id' => $cellphone_insert_id,
                'ppu_id' => $passport_insert_id,
                'ppc_status' => 'N',
                'created_at' => $now_date_time
            ]);

            if($passport_comparison_insert_id) {
                Alert::success('Olleh Mobile Registered', 'Your Mobile Application has been Registered');
                return redirect('/user/tables');
            } else {
                Alert::error('Olleh Mobile Registered', 'Your Mobile Application Fails to Register [9]');
                return back()->with('error', 'Your Mobile Application Fails to Register [9]');
            }
        } else {
            Alert::error('Olleh Mobile Registered', 'Your Mobile Application Fails to Register [7]');
            return back()->with('error', 'Mobile Application Form failed.');
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
                            ->select('cellphone_boards.*', 'signature_uploads.stu_filename', 'signature_uploads.stu_base64', 'passport_uploads.ppu_filename', 'passport_uploads.ppu_encode_filename')
                            ->get();

            if (view()->exists("pages.user.{$page}_modify")) {
                return view("pages.user.{$page}_modify", ['cell_phones' => $cell_phones]);
            }
        } else {
            return abort(404);
        }
    }

    public function modify_update(Request $request, string $page, $num) {
        
        $user_id_check = DB::table('users')->where('id', Auth::id())->value('id');
        $user_name_check = DB::table('users')->where('id', Auth::id())->value('username');
        $currentDateTime = Carbon::now()->timezone('Asia/Seoul');
        $now_date_time = $currentDateTime->toDateTimeString();

       if(DB::table('cellphone_boards')->where('u_id', Auth::id())->where('id', $num)->exists()) {

            // Form validate 구성
            $validated = $request->validate([
                'applicant' => 'required',
                'nationality' => 'required',
                'dateofbirth' => 'required',
                'passportnumber' => 'required',
                'gender' => 'required|in:male,female',
                // 'device' => 'required|in:apple,samsung,other',
                // 'devicemodel' => 'required',
                // 'osversion' => 'required',
                'imeinumber' => 'required',
                'plan' => 'required|in:ok',
                'signaturetxt' => 'required',
                // 'callservice' => 'required|in:yes,no',
                'service' => 'required|in:annual_agreement,monthly_plan',
                'connectivity' => 'required|in:4g,5g',
            ]);

            //passport 수정할 경우
            if($request->file('passport')) {
                // PassPort Upload 구성
                // $upload_file = $request->file('passport')->store('public/images/passport');
                $upload_file = Storage::putFile('/public/images/passport',$request->file('passport'));
                if($upload_file) {
                    $file_name = $request->file('passport')->getClientOriginalName();
                    $random_explode = explode('public/images/passport/', $upload_file);
                    $extension_cut = explode('.', $random_explode[1]);
                    $random_file_name = $extension_cut[0];

                    $passport_insert_id = DB::table('passport_uploads')->insertGetId([
                        'u_id' => $user_id_check,
                        'ppu_filename' => $file_name,
                        'ppu_encode_filename' => $random_file_name,
                        'created_at' => $now_date_time
                    ]);

                    $cellphone_update = DB::table('cellphone_boards')
                                        ->where('u_id', Auth::id())
                                        ->where('id', $num)
                                        ->update([
                                            'ppu_id' => $passport_insert_id,
                                            'updated_at' => $now_date_time
                                        ]);
                    if(!$cellphone_update) {
                        Alert::error('Olleh Mobile Modify', 'The passport was not DB Insert successfully. [7]');
                        return back()->with('error', 'The passport was not DB Insert successfully.');
                    }
                } else {
                    Alert::error('Olleh Mobile Modify', 'The passport was not uploaded successfully. [8]');
                    return back()->with('error', 'The passport was not uploaded successfully.');
                }
            }

            // Signature Upload 구성
            $base64_img = $request->post('signaturetxt');
            $base64_img = str_replace('data:image/png;base64,', '', $base64_img);
            $base64_img = str_replace(' ', '+', $base64_img);
            $base64_decoding_img = base64_decode($base64_img);

            // Signature 수정할 경우
            if(DB::table('signature_uploads')->where('stu_base64', $base64_img)->doesntExist()) {
                $file_name = $user_name_check.time().'.png';
                $signatures = Storage::put('/public/images/signatures/'.$file_name, $base64_decoding_img);
                if($signatures) {
                    $signature_insert_id = DB::table('signature_uploads')->insertGetId([
                        'u_id' => $user_id_check,
                        'stu_filename' => $file_name,
                        'stu_base64' => $base64_img,
                        'created_at' => $now_date_time
                    ]);

                    $cellphone_update = DB::table('cellphone_boards')
                                        ->where('u_id', Auth::id())
                                        ->where('id', $num)
                                        ->update([
                                            'stu_id' => $signature_insert_id,
                                            'updated_at' => $now_date_time
                                        ]);
                    if(!$cellphone_update) {
                        Alert::error('Olleh Mobile Modify', 'The signature was not DB Insert successfully. [7]');
                        return back()->with('error', 'The signature was not DB Insert successfully.');
                    }
                } else {
                    Alert::error('Olleh Mobile Modify', 'The signature was not uploaded successfully. [8]');
                    return back()->with('error', 'The signature was not uploaded successfully.');
                }
            }

            $applicant = $request->post('applicant');
            $nationality = $request->post('nationality');
            $dateofbirth = $request->post('dateofbirth');
            $passport_number = $request->post('passportnumber');
            $gender = $request->post('gender');
            // $device = $request->post('device');
            // $devicemodel = $request->post('devicemodel');
            // $osversion = $request->post('osversion');
            $imeinumber = $request->post('imeinumber');
            $plan = $request->post('plan');
            // $callservice = $request->post('callservice');
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


            $cellphone_update = DB::table('cellphone_boards')
                                ->where('u_id', Auth::id())
                                ->where('id', $num)
                                ->update([
                                    'cpb_applicant' => $applicant,
                                    'cpb_nationality' => $nationality,
                                    'cpb_dateofbirth' => $dateofbirth,
                                    'cpb_passportnumber' => $passport_number,
                                    'cpb_gender' => $gender,
                                    // 'cpb_device' => $device,
                                    // 'cpb_devicemodel' => $devicemodel,
                                    // 'cpb_osversion' => $osversion,
                                    'cpb_imeinumber' => $imeinumber,
                                    'cpb_plan' => $plan,
                                    'cpb_chooselastnumber' => $chooselastnumber,
                                    'cpb_referral' => $referral,
                                    // 'cpb_callservice' => $callservice,
                                    'cpb_service' => $service,
                                    'cpb_connectivity' => $connectivity,
                                    'cpb_telecoms' => 'kt',
                                    'updated_at' => $now_date_time
                                ]);

            if($cellphone_update) {
                Alert::success('Olleh Mobile Modify', 'Your Mobile Application has been Updated');
                return redirect('/user/tables');
            } else {
                Alert::error('Olleh Mobile Modify', 'Your Mobile Application Form modify failed.');
                return back()->with('error', 'Mobile Application Form modify failed.');
            }
       }
        
    }

    public function idcard(string $page, $num) {
        
        $board_check = DB::table('cellphone_boards')->where('u_id', Auth::id())->where('id', $num)->exists();
        if($board_check) {
            $idcard_check = DB::table('idcard_check_mails')
                                ->where('cpb_id', $num)
                                ->exists();
            if($idcard_check) {
                if (view()->exists("pages.user.{$page}_idcard")) {
                    return view("pages.user.{$page}_idcard", ['cpb_num' => $num]);
                }
            } else {
                return abort(404);
            }
        } else {
            return abort(404);
        }
    }

    public function idcard_insert(request $request, string $page, $num) {
        $user_id_check = DB::table('users')->where('id', Auth::id())->value('id');
        $user_name_check = DB::table('users')->where('id', Auth::id())->value('username');
        $currentDateTime = Carbon::now()->timezone('Asia/Seoul');
        $now_date_time = $currentDateTime->toDateTimeString();

        if(DB::table('cellphone_boards')->where('u_id', Auth::id())->where('id', $num)->exists()) {
            
            // Form validate 구성
            $validated = $request->validate([
                'registrationcard' => 'required',
            ]);

            // idcard Upload 구성
            $upload_file = Storage::putFile('/public/images/registrationcard',$request->file('registrationcard'));
            if($upload_file) {
                $file_name = $request->file('registrationcard')->getClientOriginalName();
                $random_explode = explode('public/images/registrationcard/', $upload_file);
                $extension_cut = explode('.', $random_explode[1]);
                $random_file_name = $extension_cut[0];

                $idcard_insert_id = DB::table('idcard_uploads')->insertGetId([
                    'u_id' => $user_id_check,
                    'icu_filename' => $file_name,
                    'icu_encode_filename' => $random_file_name,
                    'created_at' => $now_date_time
                ]);

                if($idcard_insert_id) {
                    $cellphone_update = DB::table('cellphone_boards')
                                        ->where('u_id', Auth::id())
                                        ->where('id', $num)
                                        ->update([
                                            'cpb_after_status' => 'apply',
                                            'updated_at' => $now_date_time
                                        ]);

                    if($cellphone_update) {
                        $idcard_comparison_insert_id = DB::table('idcard_comparison')->insertGetId([
                            'cpb_id' => $num,
                            'icu_id' => $idcard_insert_id,
                            'icc_status' => 'N',
                            'created_at' => $now_date_time
                        ]);
                        /**
                         * 현재는 하드코딩으로 작성된 메일로 발송되게 함
                         * 발송될 계정은 진앤현에서 갖고있는 계정으로
                         * 해당 계정에 메일이 수신되면, 자동으로 관계자들의 계정으로 전달 예정
                         */
                        Mail::send('mobileForm.admin.form', ['tables' => 'tables'], function($message) use($request, $user_name_check){
                            $message->to('kt.foreigner@jinnhyun.com');
                            $message->subject('후불제 가입 신청이 등록되었습니다._'.$user_name_check);
                        });
                          
                        Alert::success('Olleh Mobile Registered', 'The Registration Card was uploaded successfully');
                        return redirect('/user/tables');
                    }
                }

            } else {
                Alert::error('Registration Card Was Not Uploaded', 'The Registration Card was not uploaded successfully [4]');
                return back()->with('error', 'The Registration Card was not uploaded successfully.');
            }
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
