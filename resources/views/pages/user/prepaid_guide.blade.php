@extends('layouts.user.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    <script>
        $(function () {
            $('#lang_check').change(function() {
                var value = $(this).val();
                switch(value) {
                    case 'english' :
                        $('#title_lang').text("Prepaid Form Guide Documents");
                        $('#register_lang').text("Register");
                        $('#applicant_lang').text("Applicant");
                        $('#openingstatus_lang').text("Opening Status");
                        $('#deferredpaymentstatus_lang').text("Deferred Payment Status");
                        $('#registrationdate_lang').text("Registration date");
                        $('#etc_lang').text("ETC");
                        $('#dontcheck_lang').text("Don't have a history of applying for Prepaid Application Form");
                        break;
                    case 'russian' :
                        $('#title_lang').text("Руководство по предоплаченной форме");
                        $('#register_lang').text("регистр");
                        $('#applicant_lang').text("Заявитель");
                        $('#openingstatus_lang').text("Статус открытия");
                        $('#deferredpaymentstatus_lang').text("Статус отсроченного платежа");
                        $('#registrationdate_lang').text("Дата регистрации");
                        $('#etc_lang').text("И Т. Д");
                        $('#dontcheck_lang').text("У вас нет истории подачи заявки на предоплаченную форму заявки.");
                        break;
                    case 'uzbek' :
                        $('#title_lang').text("Oldindan to'langan shakl qo'llanma hujjatlari");
                        $('#register_lang').text("ro'yxatdan o'tish");
                        $('#applicant_lang').text("Ariza beruvchi");
                        $('#openingstatus_lang').text("Ochilish holati");
                        $('#deferredpaymentstatus_lang').text("Kechiktirilgan to'lov holati");
                        $('#registrationdate_lang').text("Ro'yxatdan o'tish sanasi");
                        $('#etc_lang').text("VA BOSHQALAR");
                        $('#dontcheck_lang').text("Oldindan to'langan ariza shakliga ariza topshirish tarixi yo'q");
                        break;
                    case 'tagalog' :
                        $('#title_lang').text("Prepaid Form Guide Documents");
                        $('#register_lang').text("magparehistro");
                        $('#applicant_lang').text("Aplikante");
                        $('#openingstatus_lang').text("Katayuan ng Pagbubukas");
                        $('#deferredpaymentstatus_lang').text("Katayuan ng Deferred Payment");
                        $('#registrationdate_lang').text("Petsa ng pagpaparehistro");
                        $('#etc_lang').text("ETC");
                        $('#dontcheck_lang').text("Walang kasaysayan ng pag-apply para sa Prepaid Application Form");
                        break;
                    case 'vietnamese' :
                        $('#title_lang').text("Tài liệu hướng dẫn biểu mẫu trả trước");
                        $('#register_lang').text("đăng ký");
                        $('#applicant_lang').text("Người xin việc");
                        $('#openingstatus_lang').text("Trạng thái mở");
                        $('#deferredpaymentstatus_lang').text("Trạng thái thanh toán trả chậm");
                        $('#registrationdate_lang').text("Ngày đăng kí");
                        $('#etc_lang').text("VÂN VÂN");
                        $('#dontcheck_lang').text("Không có lịch sử đăng ký Mẫu đơn đăng ký trả trước");
                        break;
                    default :
                        break;
                }
            });
        });
    </script>
    @include('layouts.navbars.auth.user.topnav', ['title' => 'Prepaid Form Guide Documents'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6 id="title_lang">Prepaid Form Guide Documents</h6>
                    </div>
                    <div class="pb-0">
                        <div style="float:right; width:130px; height:40px;">
                            <select class="lang_check" id="lang_check">
                                <option value="english" selected="">English</option>
                                <option value="russian">Russian</option>
                                <option value="uzbek">Uzbek</option>
                                <option value="tagalog">Tagalog</option>
                                <option value="vietnamese">Vietnamese</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <div>
                                <div>
                                    <h4>Before issuance of alien registration card (issued in Korea)</h4>
                                </div>
                                <div>
                                    <p> - 메뉴 중 Prepaid Application Form 메뉴를 선택 후 Register 버튼 클릭</p>
                                    <div>
                                        <img src="/img/tables/before_1.png" alt="Prepaid Plan" style="max-width: 100%; height: auto;">
                                        <img src="/img/tables/before_2.png" alt="Prepaid Plan" style="max-width: 100%; height: auto;">
                                    </div>
                                    <p> - 해당되는 언어를 선택 후 제공되는 양식에 맞춰 가입신청서 작성</p>
                                    <div>
                                        <img src="/img/tables/before_3.png" alt="Prepaid Plan" style="max-width: 100%; height: auto;">
                                    </div>
                                    <p> - 작성 완료 후 Opening Status가 Opening일 경우 작성한 가입신청서 수정 가능</p>
                                    <div>
                                        <img src="/img/tables/before_4.png" alt="Prepaid Plan" style="max-width: 100%; height: auto;">
                                    </div>
                                    <p> - KT 가입 관련 프로세스 진행시 Prepaid Application Form 메뉴를 통해 진행상황 확인 가능</p>
                                    <p> - 선불제 가입신청이 최종 완료되면 회원가입시 작성된 E-mail로 안내 메일 발송</p>
                                    <div>
                                        <img src="/img/tables/before_5.png" alt="Prepaid Plan" style="max-width: 100%; height: auto;">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <h4>After issuance of alien registration card (issued in Korea)</h4>
                                </div>
                                <div>
                                    <p> - 메뉴 중 Prepaid Application Form 메뉴를 선택 후 작성한 선불제 가입신청 이력 중 Deferred Payment Status 부분의 등록버튼을 클릭</p>
                                    <p> - 해당되는 언어를 선택 후 제공되는 양식에 맞춰 가입신청서 작성</p>
                                    <p> - 작성 완료 후 한국 담당자가 가입신청 작업 전까지 작성한 가입신청서 수정 가능</p>
                                    <p> - KT 가입 관련 프로세스 진행시 Prepaid Application Form 메뉴를 통해 진행상황 확인 가능</p>
                                    <p> - 선불제 가입신청이 최종 완료되면 회원가입시 작성된 E-mail로 안내 메일 발송</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.user.footer')
    </div>
@endsection
