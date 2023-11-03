@extends('layouts.user.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    <script>
        $(function () {
            $('#lang_check').change(function() {
                var value = $(this).val();
                switch(value) {
                    case 'english' :
                        $('#title_lang').text("Postpaid Form Guide Documents");
                        $('#register_lang').text("Register");
                        $('#applicant_lang').text("Applicant");
                        $('#openingstatus_lang').text("Opening Status");
                        $('#deferredpaymentstatus_lang').text("Deferred Payment Status");
                        $('#registrationdate_lang').text("Registration date");
                        $('#etc_lang').text("ETC");
                        $('#dontcheck_lang').text("Don't have a history of applying for Prepaid Application Form");
                        break;
                    case 'russian' :
                        $('#title_lang').text("Руководство по формам постоплаты");
                        $('#register_lang').text("регистр");
                        $('#applicant_lang').text("Заявитель");
                        $('#openingstatus_lang').text("Статус открытия");
                        $('#deferredpaymentstatus_lang').text("Статус отсроченного платежа");
                        $('#registrationdate_lang').text("Дата регистрации");
                        $('#etc_lang').text("И Т. Д");
                        $('#dontcheck_lang').text("У вас нет истории подачи заявки на предоплаченную форму заявки.");
                        break;
                    case 'uzbek' :
                        $('#title_lang').text("Postpaid shakli uchun qo'llanma hujjatlari");
                        $('#register_lang').text("ro'yxatdan o'tish");
                        $('#applicant_lang').text("Ariza beruvchi");
                        $('#openingstatus_lang').text("Ochilish holati");
                        $('#deferredpaymentstatus_lang').text("Kechiktirilgan to'lov holati");
                        $('#registrationdate_lang').text("Ro'yxatdan o'tish sanasi");
                        $('#etc_lang').text("VA BOSHQALAR");
                        $('#dontcheck_lang').text("Oldindan to'langan ariza shakliga ariza topshirish tarixi yo'q");
                        break;
                    case 'tagalog' :
                        $('#title_lang').text("Postpaid Form Guide Documents");
                        $('#register_lang').text("magparehistro");
                        $('#applicant_lang').text("Aplikante");
                        $('#openingstatus_lang').text("Katayuan ng Pagbubukas");
                        $('#deferredpaymentstatus_lang').text("Katayuan ng Deferred Payment");
                        $('#registrationdate_lang').text("Petsa ng pagpaparehistro");
                        $('#etc_lang').text("ETC");
                        $('#dontcheck_lang').text("Walang kasaysayan ng pag-apply para sa Prepaid Application Form");
                        break;
                    case 'vietnamese' :
                        $('#title_lang').text("Tài liệu hướng dẫn biểu mẫu trả sau");
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
    @include('layouts.navbars.auth.user.topnav', ['title' => 'Postpaid Form Guide Documents'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6 id="title_lang">Postpaid Form Guide Documents</h6>
                    </div>
                    <div class="pb-0">
                        <div style="float:right; width:160px; height:40px;">
                            <a class="bg-gradient-success" style="padding:10px; font-weight:bold; color:#fff; border-radius:10px 10px 10px 10px; cursor: pointer" 
                            href="{{ route('userpage.register', ['page' => 'tables']) }}" id="register_lang">
                                Register
                            </a>
                        </div>
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

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.user.footer')
    </div>
@endsection
