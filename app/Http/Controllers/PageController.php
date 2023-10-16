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
                            ->exists();

        /**
         * admin 일 경우 등록된 모든 정보 리스트업
         * kt값만 추출
         */
        if($admin_checks > 0) {
            $cell_phones = DB::table('cellphone_boards')
                            ->join('users', 'cellphone_boards.u_id', '=' ,'users.id')
                            ->join('passport_comparison', 'cellphone_boards.id', '=' ,'passport_comparison.cpb_id')
                            ->where('cellphone_boards.cpb_telecoms', 'kt')
                            ->select('users.username', 'users.email', 'cellphone_boards.id', 'cellphone_boards.cpb_applicant', 'cellphone_boards.cpb_nationality', 'cellphone_boards.cpb_status', 'cellphone_boards.cpb_telecoms', 'cellphone_boards.created_at', 'passport_comparison.ppc_status', 'passport_comparison.id AS ppc_id')
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
        } else {
            return abort(404);
        }
    }

    public function comparison(Request $request, string $page, $num) {
        $currentDateTime = Carbon::now()->timezone('Asia/Seoul');
        $now_date_time = $currentDateTime->toDateTimeString();

        if(DB::table('cellphone_boards')->where('id', $num)->exists()) {

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
                /**
                 * 현재는 하드코딩으로 작성된 메일로 발송되게 함
                 * 추후 해당 업무 담당자들에게 발송되게 User Table에서 email 추출해서 전달해야됨
                 */
                $datae = [];
                Mail::send('mobileForm.user.status', $datae, function($message) use($user_check, $now_date_time) {
                    $message->to($user_check->email);
                    $message->subject('Olle mobile application is finally complete.'.$now_date_time);
                });

                Alert::success('가입신청 상태 변경', '가입신청 상태 변경이 완료되었습니다.');
                return redirect("/admin/tables");
            } else {
                Alert::error('가입신청 상태 변경', '가입신청 상태 변경이 실패하였습니다.');
                return redirect("/admin/tables");
            }
        }
    }
}
