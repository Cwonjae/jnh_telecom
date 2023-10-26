@extends('layouts.user.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    <script>
        $(function () {
            $('#lang_check').change(function() {
                var value = $(this).val();
                switch(value) {
                    case 'english' :
                        $('#title_lang').text("Postpaid Application Form");
                        $('#register_lang').text("Register");
                        $('#applicant_lang').text("Applicant");
                        $('#openingstatus_lang').text("Opening Status");
                        $('#deferredpaymentstatus_lang').text("Deferred Payment Status");
                        $('#registrationdate_lang').text("Registration date");
                        $('#etc_lang').text("ETC");
                        $('#dontcheck_lang').text("Don't have a history of applying for Postpaid Application Form");
                        break;
                    case 'russian' :
                        $('#title_lang').text("Форма заявки на постоплату");
                        $('#register_lang').text("регистр");
                        $('#applicant_lang').text("Заявитель");
                        $('#openingstatus_lang').text("Статус открытия");
                        $('#deferredpaymentstatus_lang').text("Статус отсроченного платежа");
                        $('#registrationdate_lang').text("Дата регистрации");
                        $('#etc_lang').text("И Т. Д");
                        $('#dontcheck_lang').text("У вас нет истории подачи заявки на постоплатную форму заявки.");
                        break;
                    case 'uzbek' :
                        $('#title_lang').text("Postpaid ariza shakli");
                        $('#register_lang').text("ro'yxatdan o'tish");
                        $('#applicant_lang').text("Ariza beruvchi");
                        $('#openingstatus_lang').text("Ochilish holati");
                        $('#deferredpaymentstatus_lang').text("Kechiktirilgan to'lov holati");
                        $('#registrationdate_lang').text("Ro'yxatdan o'tish sanasi");
                        $('#etc_lang').text("VA BOSHQALAR");
                        $('#dontcheck_lang').text("Postpaid anketasiga ariza topshirish tarixi yo'q");
                        break;
                    case 'tagalog' :
                        $('#title_lang').text("Postpaid Application Form");
                        $('#register_lang').text("magparehistro");
                        $('#applicant_lang').text("Aplikante");
                        $('#openingstatus_lang').text("Katayuan ng Pagbubukas");
                        $('#deferredpaymentstatus_lang').text("Katayuan ng Deferred Payment");
                        $('#registrationdate_lang').text("Petsa ng pagpaparehistro");
                        $('#etc_lang').text("ETC");
                        $('#dontcheck_lang').text("Walang kasaysayan ng pag-apply para sa Postpaid Application Form");
                        break;
                    case 'vietnamese' :
                        $('#title_lang').text("Đơn đăng ký trả sau");
                        $('#register_lang').text("đăng ký");
                        $('#applicant_lang').text("Người xin việc");
                        $('#openingstatus_lang').text("Trạng thái mở");
                        $('#deferredpaymentstatus_lang').text("Trạng thái thanh toán trả chậm");
                        $('#registrationdate_lang').text("Ngày đăng kí");
                        $('#etc_lang').text("VÂN VÂN");
                        $('#dontcheck_lang').text("Không có lịch sử nộp đơn đăng ký trả sau");
                        break;
                    default :
                        break;
                }
            });
        });
    </script>
    @include('layouts.navbars.auth.user.topnav', ['title' => 'Postpaid Application Form'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6 id="title_lang">Postpaid Application Form</h6>
                    </div>
                    <div class="pb-0">
                        <div style="float:right; width:120px; height:40px;">
                            <a class="bg-gradient-success" style="padding:10px; font-weight:bold; color:#fff; border-radius:10px 10px 10px 10px; cursor: pointer" 
                            href="{{ route('userpage.register', ['page' => 'posts']) }}" id="register_lang">
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
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" id="applicant_lang">
                                            Applicant</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" id="deferredpaymentstatus_lang">
                                            Deferred Payment Status</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" id="openingstatus_lang">
                                            Opening Status</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" id="registrationdate_lang">
                                            Registration date</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" id="etc_lang">
                                            ETC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($cell_phones as $cell_phone)
                                    <tr>
                                        <td class="align-middle text-center">
                                            <div class="px-2 py-1">
                                                <div class="flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm text-center">{{ $cell_phone->cpb_applicant }}</h6>
                                                    <p class="text-xs text-secondary text-center mb-0">{{ $cell_phone->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            @if ($cell_phone->cpb_after_status == 'apply')
                                                <span class="badge badge-sm bg-gradient-success">Complete</span>
                                            @elseif ($cell_phone->cpb_after_status == 'applying')
                                                <span class="badge badge-sm bg-gradient-primary">Applying</span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-danger">
                                                    @if ($cell_phone->iccm_id)
                                                        <a href="{{ route('userpage.idcard', ['page' => 'tables', 'num' => $cell_phone->id]) }}" target="_blank" style="color:#fff;">To apply Click</a>
                                                    @else
                                                        To apply
                                                    @endif
                                                </span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm
                                            @if ($cell_phone->cpb_status == 'opening') 
                                                bg-gradient-success
                                            @elseif ($cell_phone->cpb_status == 'pending')
                                                bg-gradient-danger
                                            @else
                                                bg-gradient-secondary
                                            @endif
                                            ">{{ $cell_phone->cpb_status }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ date('Y-m-d H:i:s', strtotime($cell_phone->created_at)) }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            @if ($cell_phone->cpb_status == 'closing' || $cell_phone->cpb_status == 'pending')

                                            @else
                                                <a href="{{ route('userpage.modify', ['page' => 'posts', 'num' => $cell_phone->id]) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                    Edit
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td class="align-middle text-center" colspan="5" id="dontcheck_lang">Don't have a history of applying for Postpaid Application Form</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="card-header pb-0">
                                {{ $cell_phones->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.user.footer')
    </div>
@endsection
