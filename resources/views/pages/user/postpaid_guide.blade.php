@extends('layouts.user.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    <script>
        $(function () {
            $('#lang_check').change(function() {
                var value = $(this).val();
                switch(value) {
                    case 'english' :
                        $('#title_lang').text("Postpaid Form Guide Documents");
                        $('#postpaid_title_lang').text("If you sign up for a prepaid plan at another dealership and sign up for a postpaid plan separately");
                        $('#postpaid_1_lang').text("Select the Postpaid Application form menu from the menu and click the Register button");
                        $('#postpaid_2_lang').text("Select the applicable language and fill out the membership application form in the form provided");
                        $('#postpaid_3_lang').text("When completed properly, you can check the Deferred Payment Status on the Postpaid Application Form page");
                        $('#postpaid_4_lang').text("Once the postpaid application is finalized, a notification email will be sent to the email address provided during membership registration");
                        break;
                    case 'russian' :
                        $('#title_lang').text("Руководство по формам постоплаты");
                        $('#postpaid_title_lang').text("Если вы подписались на предоплаченный план в другом дилерском центре и отдельно подписались на постоплатный план");
                        $('#postpaid_1_lang').text("Выберите в меню форму заявления с постоплатой и нажмите кнопку «Зарегистрироваться»");
                        $('#postpaid_2_lang').text("Выберите подходящий язык и заполните форму заявки на членство в предоставленной форме");
                        $('#postpaid_3_lang').text("При правильном заполнении вы можете проверить статус отсроченного платежа на странице формы заявления с постоплатой");
                        $('#postpaid_4_lang').text("Как только постоплатная заявка будет завершена, на адрес электронной почты, указанный при регистрации членства, будет отправлено уведомление по электронной почте");
                        break;
                    case 'uzbek' :
                        $('#title_lang').text("Postpaid shakli uchun qo'llanma hujjatlari");
                        $('#postpaid_title_lang').text("Agar siz boshqa dilerda oldindan to'lov rejasiga ro'yxatdan o'tsangiz va keyin to'lov rejasiga alohida ro'yxatdan o'tsangiz");
                        $('#postpaid_1_lang').text("Menyudan Postpaid ariza shakli menyusini tanlang va Ro'yxatdan o'tish tugmasini bosing");
                        $('#postpaid_2_lang').text("Tegishli tilni tanlang va taqdim etilgan shaklda a'zolik ariza shaklini to'ldiring");
                        $('#postpaid_3_lang').text("To'g'ri to'ldirilgandan so'ng, keyin to'lov shakli sahifasida kechiktirilgan to'lov holatini tekshirishingiz mumkin");
                        $('#postpaid_4_lang').text("Postpaid arizasi yakunlangandan so'ng, a'zolikni ro'yxatdan o'tkazish paytida ko'rsatilgan elektron pochta manziliga xabarnoma yuboriladi");
                        break;
                    case 'tagalog' :
                        $('#title_lang').text("Postpaid Form Guide Documents");
                        $('#postpaid_title_lang').text("Kung mag-sign up ka para sa isang prepaid plan sa ibang dealership at mag-sign up para sa isang postpaid plan nang hiwalay");
                        $('#postpaid_1_lang').text("Piliin ang Postpaid Application form menu mula sa menu at i-click ang Register button");
                        $('#postpaid_2_lang').text("Piliin ang naaangkop na wika at punan ang form ng aplikasyon ng membership sa ibinigay na form");
                        $('#postpaid_3_lang').text("Kapag nakumpleto nang maayos, maaari mong tingnan ang Deferred Payment Status sa Postpaid Application Form na pahina");
                        $('#postpaid_4_lang').text("Kapag natapos na ang postpaid application, magpapadala ng notification email sa email address na ibinigay sa panahon ng membership registration");
                        break;
                    case 'vietnamese' :
                        $('#title_lang').text("Tài liệu hướng dẫn biểu mẫu trả sau");
                        $('#postpaid_title_lang').text("Nếu bạn đăng ký gói trả trước tại một đại lý khác và đăng ký riêng gói trả sau");
                        $('#postpaid_1_lang').text("Chọn menu mẫu Đơn đăng ký trả sau từ menu và nhấp vào nút Đăng ký");
                        $('#postpaid_2_lang').text("Chọn ngôn ngữ áp dụng và điền vào mẫu đơn đăng ký thành viên theo mẫu được cung cấp");
                        $('#postpaid_3_lang').text("Khi hoàn thành đúng cách, bạn có thể kiểm tra Trạng thái thanh toán trả chậm trên trang Mẫu đơn đăng ký trả sau");
                        $('#postpaid_4_lang').text("Sau khi hoàn tất đăng ký trả sau, một email thông báo sẽ được gửi đến địa chỉ email được cung cấp trong quá trình đăng ký thành viên");
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
                            <div class="card-header pb-0">
                                    <div>
                                        <h4 id="postpaid_title_lang">If you sign up for a prepaid plan at another dealership and sign up for a postpaid plan separately</h4>
                                    </div>
                                    <br/>
                                    <div>
                                        <p id="postpaid_1_lang"> - Select the Postpaid Application form menu from the menu and click the Register button.</p>
                                        <div style="text-align:center; width:80%; margin:0 auto;">
                                            <img src="/img/tables/postpaid_1.png" alt="Prepaid Plan" style="width: 236px; max-width: 100%; height: auto;">
                                            <img src="/img/tables/postpaid_2.png" alt="Prepaid Plan" style="max-width: 100%; height: auto;">
                                        </div>
                                        <br/>
                                        <p id="postpaid_2_lang"> - Select the applicable language and fill out the membership application form in the form provided</p>
                                        <br/>
                                        <p id="postpaid_3_lang"> - When completed properly, you can check the Deferred Payment Status on the Postpaid Application Form page</p>
                                        <div style="text-align:center; width:80%; margin:0 auto;">
                                            <img src="/img/tables/postpaid_3.png" alt="Prepaid Plan" style="max-width: 100%; height: auto;">
                                        </div>
                                        <br/>
                                        <p id="postpaid_4_lang"> - Once the postpaid application is finalized, a notification email will be sent to the email address provided during membership registration</p>
                                        <div style="text-align:center; width:80%; margin:0 auto;">
                                            <img src="/img/tables/postpaid_4.png" alt="Prepaid Plan" style="max-width: 100%; height: auto;">
                                        </div>
                                    </div>
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
