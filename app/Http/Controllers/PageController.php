<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Mail;

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
        $admin_checks = DB::table('users')
                            ->where('id', Auth::id())
                            ->where('grade', 'admin')
                            ->count();

        if($page == "tables") {
            /**
             * admin 일 경우 등록된 이동통신 가입신청 모든 정보 리스트업
             * kt값만 추출
             */
            if($admin_checks > 0) {
                $cell_phones = DB::table('cellphone_boards')
                                ->join('users', 'cellphone_boards.u_id', '=' ,'users.id')
                                ->join('passport_comparison', 'cellphone_boards.id', '=' ,'passport_comparison.cpb_id')
                                ->where('cellphone_boards.cpb_telecoms', 'kt')
                                ->select('users.username', 'users.email', 'cellphone_boards.id', 'cellphone_boards.cpb_applicant', 'cellphone_boards.cpb_nationality', 'cellphone_boards.cpb_status', 'cellphone_boards.cpb_after_status', 'cellphone_boards.cpb_telecoms', 'cellphone_boards.created_at', 'passport_comparison.ppc_status', 'passport_comparison.id AS ppc_id')
                                ->paginate(10);
            } else {
                return abort(404);
            }

            if (view()->exists("pages.{$page}")) {
                return view("pages.{$page}", ['cell_phones' => $cell_phones]);
            }
        } else if($page == "users") {
            /**
             * admin 일 경우 user 리스트업
             * 회원가입 한 사람들을 추출 하냐, 이동통신사업 가입신청을 완료한 사람들을 추출 하냐 고민
             * 
             */
            if($admin_checks > 0) {
                $cell_phones = DB::table('cellphone_boards')
                                ->join('users', 'cellphone_boards.u_id', '=' ,'users.id')
                                ->leftjoin('idcard_comparison', 'cellphone_boards.id', '=' ,'idcard_comparison.cpb_id')
                                ->where('cellphone_boards.cpb_telecoms', 'kt')
                                ->where('cellphone_boards.cpb_status', 'closing')
                                ->select('users.username', 'users.email', 'cellphone_boards.id', 'cellphone_boards.cpb_applicant', 'cellphone_boards.cpb_nationality', 'cellphone_boards.cpb_status', 'cellphone_boards.cpb_after_status', 'cellphone_boards.cpb_telecoms', 'cellphone_boards.created_at', 'idcard_comparison.icc_status', 'idcard_comparison.id AS icc_id', 'cellphone_boards.cpb_phonenumber')
                                ->paginate(10);
            } else {
                return abort(404);
            }

            if (view()->exists("pages.{$page}")) {
                return view("pages.{$page}", ['cell_phones' => $cell_phones]);
            }
        } else {
            return abort(404);
        }

        return abort(404);
    }

    public function print(string $page, $num) {
        if($page == "print") {
            $board_check = DB::table('cellphone_boards')->where('id', $num)->exists();
            if($board_check) {
                $cell_phones = DB::table('cellphone_boards')
                                ->join('signature_uploads', 'cellphone_boards.stu_id', '=' ,'signature_uploads.id')
                                ->join('passport_uploads', 'cellphone_boards.ppu_id', '=' ,'passport_uploads.id')
                                ->join('users', 'cellphone_boards.u_id', '=' ,'users.id')
                                ->where('cellphone_boards.id', $num)
                                ->select('cellphone_boards.*', 'signature_uploads.stu_filename', 'signature_uploads.stu_base64', 'passport_uploads.ppu_filename', 'passport_uploads.ppu_encode_filename', 'users.email')
                                ->get();
    
                if (view()->exists("pages.{$page}")) {
                    return view("pages.{$page}", ['cell_phones' => $cell_phones]);
                } else {
                    return abort(404);
                }
            } else {
                return abort(404);
            }
        } else if($page == "comparison") {
            $comparison_check = DB::table('passport_comparison')->where('id', $num)->exists();
            if($comparison_check) {
                $comparisons = DB::table('passport_comparison')
                                ->join('cellphone_boards', 'passport_comparison.cpb_id', '=', 'cellphone_boards.id')
                                ->join('passport_uploads', 'passport_comparison.ppu_id', '=', 'passport_uploads.id')
                                ->where('passport_comparison.id', $num)
                                ->select('cellphone_boards.id', 'cellphone_boards.cpb_passportnumber', 'passport_uploads.ppu_filename', 'passport_uploads.ppu_encode_filename')
                                ->get();
    
                if (view()->exists("pages.{$page}s")) {
                    return view("pages.{$page}s", ['comparisons' => $comparisons]);
                } else {
                    return abort(404);
                }
            } else {
                return abort(404);
            }
        } else if($page == "phone_number") {
            $cellphone_check = DB::table('cellphone_boards')->where('id', $num)->exists();
            if($cellphone_check) {
                $cellphone = DB::table('cellphone_boards')
                                ->where('cellphone_boards.id', $num)
                                ->select('cellphone_boards.id', 'cellphone_boards.cpb_phonenumber')
                                ->get();
    
                if (view()->exists("pages.{$page}")) {
                    return view("pages.{$page}", ['cellphone' => $cellphone]);
                } else {
                    return abort(404);
                }
            } else {
                return abort(404);
            }

        } else if($page == "registration_card") {
            $idcard_check = DB::table('idcard_comparison')->where('id', $num)->exists();
            if($idcard_check) {
                $idcard = DB::table('idcard_comparison')
                                ->join('cellphone_boards', 'idcard_comparison.cpb_id', '=', 'cellphone_boards.id')
                                ->join('idcard_uploads', 'idcard_comparison.icu_id', '=', 'idcard_uploads.id')
                                ->where('idcard_comparison.id', $num)
                                ->select('cellphone_boards.id', 'cellphone_boards.cpb_phonenumber', 'idcard_uploads.icu_filename', 'idcard_uploads.icu_encode_filename')
                                ->get();
    
                if (view()->exists("pages.{$page}")) {
                    return view("pages.{$page}", ['idcard' => $idcard]);
                } else {
                    return abort(404);
                }
            } else {
                return abort(404);
            }
        } else {
            return abort(404);
        }
    }

    public function comparison(Request $request, string $page, $num) {
        $currentDateTime = Carbon::now()->timezone('Asia/Seoul');
        $now_date_time = $currentDateTime->toDateTimeString();

        if(DB::table('cellphone_boards')->where('id', $num)->exists()) {
            
            if($page == "comparisons") {
                // Form validate 구성
                $validated = $request->validate([
                    'passportnumber' => 'required'
                ]);
                
                $passport_number = $request->post('passportnumber');
    
                $cellphone_update = DB::table('cellphone_boards')
                                    ->where('id', $num)
                                    ->update([
                                        'cpb_passportnumber' => $passport_number,
                                        'updated_at' => $now_date_time
                                    ]);
    
                if($cellphone_update) {
                    $comparison_update = DB::table('passport_comparison')
                                        ->where('cpb_id', $num)
                                        ->update([
                                            'ppc_status' => 'Y',
                                            'updated_at' => $now_date_time
                                        ]);
    
                    Alert::success('PassPort 검증', 'PassPort 검증이 완료되었습니다.');
                    return redirect("/admin/tables");
                } else {
                    Alert::error('PassPort 검증', 'PassPort 검증이 실패하였습니다.');
                    return redirect("/admin/tables");
                }

            } else if($page == "phone_number_insert") {
                // Form validate 구성
                $validated = $request->validate([
                    'phone_number' => 'required'
                ]);
                
                $phone_number = $request->post('phone_number');
    
                $cellphone_update = DB::table('cellphone_boards')
                                    ->where('id', $num)
                                    ->update([
                                        'cpb_phonenumber' => $phone_number,
                                        'updated_at' => $now_date_time
                                    ]);
    
    
                Alert::success('휴대폰번호', '휴대폰번호 입력이 완료되었습니다.');
                return redirect("/admin/users");
            } else if($page == "registration_card") {
                // Form validate 구성
                $validated = $request->validate([
                    'phone_number' => 'required'
                ]);
                
                $phone_number = $request->post('phone_number');
    
                $cellphone_update = DB::table('cellphone_boards')
                                    ->where('id', $num)
                                    ->update([
                                        'cpb_phonenumber' => $phone_number,
                                        'updated_at' => $now_date_time
                                    ]);
    
    
                Alert::success('휴대폰번호 및 외국인등록증', '휴대폰번호 및 외국인등록증 확인이 완료되었습니다.');
                return redirect("/admin/users");
            }

        } else {
            Alert::error('검증', '검증이 실패하였습니다.');
            return redirect("/admin/tables");
        }        
    }

    public function status_change(Request $request, string $page, $num, string $status) {
        $currentDateTime = Carbon::now()->timezone('Asia/Seoul');
        $now_date_time = $currentDateTime->toDateTimeString();

        if(DB::table('cellphone_boards')->where('id', $num)->where('cpb_status', 'opening')->exists()) {
            $cellphone_update = DB::table('cellphone_boards')
                                ->where('id', $num)
                                ->update([
                                    'cpb_status' => $status,
                                    'updated_at' => $now_date_time
                                ]);
            if($cellphone_update) {
                $user_check = DB::table('cellphone_boards')
                                        ->join('users', 'cellphone_boards.u_id', '=', 'users.id')
                                        ->where('cellphone_boards.id', $num)
                                        ->select('users.email')
                                        ->first();
                                        
                $datae = [];
                Mail::send('mobileForm.user.status', $datae, function($message) use($user_check, $now_date_time) {
                    $message->to($user_check->email);
                    $message->subject('Olleh mobile application is finally complete.'.$now_date_time);
                });

                Alert::success('가입신청 상태 변경', '가입신청 상태 변경이 완료되었습니다.');
                return redirect("/admin/tables");
            } else {
                Alert::error('가입신청 상태 변경', '가입신청 상태 변경이 실패하였습니다.');
                return redirect("/admin/tables");
            }
        }
    }

    public function views(string $page, $num) {
        $board_check = DB::table('cellphone_boards')->where('id', $num)->exists();
        if($board_check) {
            $cell_phones = DB::table('cellphone_boards')
                            ->join('signature_uploads', 'cellphone_boards.stu_id', '=' ,'signature_uploads.id')
                            ->join('passport_uploads', 'cellphone_boards.ppu_id', '=' ,'passport_uploads.id')
                            ->where('cellphone_boards.id', $num)
                            ->select('cellphone_boards.*', 'signature_uploads.stu_filename', 'signature_uploads.stu_base64', 'passport_uploads.ppu_filename', 'passport_uploads.ppu_encode_filename')
                            ->get();

            if (view()->exists("pages.{$page}_views")) {
                return view("pages.{$page}_views", ['cell_phones' => $cell_phones]);
            }
        } else {
            return abort(404);
        }
    }

    /**
     * 선불제 가입신청의 상태값이 closing 인 사람한테 메일 발송하여 후불제 가입신청하게 유도
     * 
     */
    public function mail_sender(string $page, $num) {
        $board_check = DB::table('cellphone_boards')->where('id', $num)->where('cpb_status','closing')->exists();
        $currentDateTime = Carbon::now()->timezone('Asia/Seoul');
        $now_date_time = $currentDateTime->toDateTimeString();

        if($board_check) {
            $cell_phones = DB::table('cellphone_boards')
                            ->join('users', 'cellphone_boards.u_id', '=' ,'users.id')
                            ->where('cellphone_boards.id', $num)
                            ->where('cellphone_boards.cpb_status', 'closing')
                            ->select('cellphone_boards.cpb_status', 'cellphone_boards.cpb_after_status', 'users.id', 'users.email')
                            ->first();

            if($cell_phones->cpb_after_status == "not_apply") {
                /**
                 * 후불제 신청안했을 경우 메일 발송한다 (메일 발송했냐 안했냐를 DB에 저장하여 값 관리를 해야될까?)
                 * 
                 */

                $iccm_check = DB::table('idcard_check_mails')
                                ->where('cpb_id', $num)
                                ->where('u_id', $cell_phones->id)
                                ->exists();

                if($iccm_check < 1) {
                    $idcard_check_mail_sql = DB::table('idcard_check_mails')->insertGetId([
                                                    'cpb_id' => $num,
                                                    'u_id' => $cell_phones->id,
                                                    'iccm_cnt' => 1,
                                                    'created_at' => $now_date_time
                                                ]);
                } else {
                    $idcard_check_mail_sql = DB::table('idcard_check_mails')
                                                    ->where('cpb_id', $num)
                                                    ->where('u_id', $cell_phones->id)
                                                    ->increment('iccm_cnt', 1, [
                                                        'updated_at' => $now_date_time
                                                    ]);
                }

                if($idcard_check_mail_sql) {
                    $datae = [];
                    Mail::send('mobileForm.admin.after_status', $datae, function($message) use($cell_phones, $now_date_time) {
                        $message->to($cell_phones->email);
                        $message->subject('Olleh mobile Please apply for a postpaid payment.');
                    });
                    Alert::success('이메일 발송', '해당 가입자에게 후불제 가입 요청 메일 발송 완료');
                    return redirect("/admin/users");
                } else {
                    Alert::error('이메일 발송', '메일 발송 실패 [11]');
                    return redirect("/admin/users");
                }

            } else {
                Alert::error('이메일 발송', '해당 가입자는 이미 후불제를 사용하고 있습니다.');
                return redirect("/admin/users");
            }

        } else {
            Alert::error('이메일 발송', '해당 가입자는 선불 가입절차가 종료되지 않았습니다.');
            return redirect("/admin/users");
        }
    }

}
