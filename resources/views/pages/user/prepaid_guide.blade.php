@extends('layouts.user.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    <script>
        $(function () {
            $('#lang_check').change(function() {
                var value = $(this).val();
                switch(value) {
                    case 'english' :
                        $('#title_lang').text("Prepaid Form Guide Documents");
                        $('#before_title_lang').text("Before issuance of alien registration card (issued in Korea)");
                        $('#before_1_lang').text("Select the Prepaid Application Form menu from the menu and click the Register button");
                        $('#before_2_lang').text("Select the applicable language and fill out the membership application form in the form provided");
                        $('#before_3_lang').text("After completion of completion, if the Opening Status is Opening, you can edit the completed application");
                        $('#before_4_lang').text("When proceeding with the KT subscription-related process, you can check the progress through the Prepaid Application Form menu");
                        $('#before_5_lang').text("Once the prepaid application is finalized, a notification email will be sent to the email address provided during membership registration");

                        $('#after_1_lang').text("Registration is only possible if you have received an email with instructions for signing up for the postpaid system");
                        $('#after_2_lang').text("Select the Prepaid Application Form menu from the menu and click the Apply Click button in the Deferred Payment Status section of the completed prepaid subscription application history");
                        $('#after_3_lang').text("Select the applicable language and register the Alien registration card in the form provided");
                        $('#after_4_lang').text("When proceeding with the KT subscription-related process, you can check the progress through the Prepaid Application Form menu");
                        $('#after_5_lang').text("Once the postpaid subscription application is finalized, a notification email will be sent to the email address provided during membership registration");
                        break;
                    case 'russian' :
                        $('#title_lang').text("Руководство по предоплаченной форме");
                        $('#before_title_lang').text("До выдачи регистрационной карты иностранца (выданной в Корее)");
                        $('#before_1_lang').text("Выберите в меню пункт «Форма предоплаченной заявки» и нажмите кнопку «Зарегистрироваться».");
                        $('#before_2_lang').text("Выберите подходящий язык и заполните форму заявки на членство в предоставленной форме.");
                        $('#before_3_lang').text("После завершения оформления, если Статус открытия — «Открывается», вы можете редактировать заполненную заявку.");
                        $('#before_4_lang').text("Приступая к процессу, связанному с подпиской KT, вы можете проверить ход выполнения через меню формы предоплаченной заявки.");
                        $('#before_5_lang').text("Как только предоплаченная заявка будет завершена, на адрес электронной почты, указанный при регистрации членства, будет отправлено уведомление");

                        $('#after_1_lang').text("Регистрация возможна только в том случае, если вы получили электронное письмо с инструкциями по регистрации в постоплатной системе");
                        $('#after_2_lang').text("Выберите в меню форму заявки на предоплаченную подписку и нажмите кнопку «Применить». Нажмите кнопку «Статус отсроченного платежа» в истории заполненной заявки на предоплаченную подписку");
                        $('#after_3_lang').text("Выберите подходящий язык и зарегистрируйте регистрационную карту иностранца в предоставленной форме");
                        $('#after_4_lang').text("Приступая к процессу, связанному с подпиской KT, вы можете проверить ход выполнения через меню формы предоплаченной заявки");
                        $('#after_5_lang').text("Как только заявка на постоплатную подписку будет завершена, на адрес электронной почты, указанный при регистрации членства, будет отправлено уведомление");
                        break;
                    case 'uzbek' :
                        $('#title_lang').text("Oldindan to'langan shakl qo'llanma hujjatlari");
                        $('#before_title_lang').text("Chet ellik ro'yxatga olish kartasini berishdan oldin (Koreyada berilgan)");
                        $('#before_1_lang').text("Menyudan Oldindan to'langan ariza shakli menyusini tanlang va Ro'yxatdan o'tish tugmasini bosing");
                        $('#before_2_lang').text("Tegishli tilni tanlang va taqdim etilgan shaklda a'zolik ariza shaklini to'ldiring");
                        $('#before_3_lang').text("Tugallash tugallangandan so'ng, agar Ochilish holati ochilmoqda bo'lsa, siz tugallangan arizani tahrirlashingiz mumkin");
                        $('#before_4_lang').text("KT obunasi bilan bog'liq jarayonni davom ettirayotganda, siz oldindan to'langan ariza shakli menyusi orqali jarayonni tekshirishingiz mumkin");
                        $('#before_5_lang').text("Oldindan toʻlangan ariza yakunlangandan soʻng, aʼzolikni roʻyxatdan oʻtkazishda koʻrsatilgan elektron pochta manziliga xabarnoma yuboriladi");

                        $('#after_1_lang').text("Ro'yxatdan o'tish faqat keyin to'lov tizimida ro'yxatdan o'tish bo'yicha ko'rsatmalar bilan elektron pochta xabarini olgan bo'lsangiz mumkin");
                        $('#after_2_lang').text("Menyudan Oldindan to'langan ariza shakli menyusini tanlang va to'ldirilgan oldindan to'langan obuna arizasi tarixining Kechiktirilgan to'lov holati bo'limidagi 'Ilova' tugmasini bosing");
                        $('#after_3_lang').text("Tegishli tilni tanlang va taqdim etilgan shaklda Alien ro'yxatga olish kartasini ro'yxatdan o'tkazing");
                        $('#after_4_lang').text("KT obunasi bilan bog'liq jarayonni davom ettirayotganda, siz oldindan to'langan ariza shakli menyusi orqali jarayonni tekshirishingiz mumkin");
                        $('#after_5_lang').text("Postpaid obunasi uchun ariza tugallangandan so'ng, a'zolikni ro'yxatdan o'tkazish paytida ko'rsatilgan elektron pochta manziliga bildirishnoma yuboriladi");
                        break;
                    case 'tagalog' :
                        $('#title_lang').text("Prepaid Form Guide Documents");
                        $('#before_title_lang').text("Bago mag-isyu ng alien registration card (ibinigay sa Korea)");
                        $('#before_1_lang').text("Piliin ang Prepaid Application Form menu mula sa menu at i-click ang Register button");
                        $('#before_2_lang').text("Piliin ang naaangkop na wika at punan ang form ng aplikasyon ng membership sa ibinigay na form");
                        $('#before_3_lang').text("Matapos makumpleto ang pagkumpleto, kung ang Katayuan ng Pagbubukas ay Pagbubukas, maaari mong i-edit ang nakumpletong aplikasyon");
                        $('#before_4_lang').text("Kapag nagpapatuloy sa prosesong nauugnay sa subscription sa KT, maaari mong tingnan ang progreso sa pamamagitan ng menu ng Prepaid Application Form");
                        $('#before_5_lang').text("Kapag natapos na ang prepaid na aplikasyon, ipapadala ang isang email ng notification sa email address na ibinigay sa panahon ng pagpaparehistro ng membership");

                        $('#after_1_lang').text("Posible lamang ang pagpaparehistro kung nakatanggap ka ng email na may mga tagubilin para sa pag-sign up para sa postpaid system");
                        $('#after_2_lang').text("Piliin ang Prepaid Application Form menu mula sa menu at i-click ang Apply Click button sa Deferred Payment Status na seksyon ng nakumpletong prepaid subscription application history");
                        $('#after_3_lang').text("Piliin ang naaangkop na wika at irehistro ang Alien registration card sa ibinigay na form");
                        $('#after_4_lang').text("Kapag nagpapatuloy sa prosesong nauugnay sa subscription sa KT, maaari mong tingnan ang progreso sa pamamagitan ng menu ng Prepaid Application Form");
                        $('#after_5_lang').text("Kapag natapos na ang postpaid na aplikasyon sa subscription, magpapadala ng notification email sa email address na ibinigay sa panahon ng pagpaparehistro ng membership");
                        break;
                    case 'vietnamese' :
                        $('#title_lang').text("Tài liệu hướng dẫn biểu mẫu trả trước");
                        $('#before_title_lang').text("Trước khi cấp thẻ đăng ký người nước ngoài (được cấp tại Hàn Quốc)");
                        $('#before_1_lang').text("Chọn menu Mẫu đơn đăng ký trả trước từ menu và nhấp vào nút Đăng ký");
                        $('#before_2_lang').text("Chọn ngôn ngữ áp dụng và điền vào mẫu đơn đăng ký thành viên theo mẫu được cung cấp");
                        $('#before_3_lang').text("Sau khi hoàn thành, nếu Trạng thái mở là Đang mở, bạn có thể chỉnh sửa ứng dụng đã hoàn thành");
                        $('#before_4_lang').text("Khi tiến hành quy trình liên quan đến đăng ký KT, bạn có thể kiểm tra tiến trình thông qua menu Mẫu đơn đăng ký trả trước");
                        $('#before_5_lang').text("Sau khi đơn đăng ký trả trước được hoàn tất, một email thông báo sẽ được gửi đến địa chỉ email được cung cấp trong quá trình đăng ký thành viên");

                        $('#after_1_lang').text("Chỉ có thể đăng ký nếu bạn nhận được email hướng dẫn đăng ký hệ thống trả sau");
                        $('#after_2_lang').text("Chọn menu Mẫu đơn đăng ký trả trước từ menu và nhấp vào nút Áp dụng Nhấp chuột trong phần Trạng thái thanh toán trả chậm của lịch sử đăng ký trả trước đã hoàn thành");
                        $('#after_3_lang').text("Chọn ngôn ngữ áp dụng và đăng ký thẻ đăng ký người nước ngoài theo mẫu được cung cấp");
                        $('#after_4_lang').text("Khi tiến hành quy trình liên quan đến đăng ký KT, bạn có thể kiểm tra tiến trình thông qua menu Mẫu đơn đăng ký trả trước");
                        $('#after_5_lang').text("Sau khi hoàn tất đăng ký thuê bao trả sau, một email thông báo sẽ được gửi đến địa chỉ email được cung cấp trong quá trình đăng ký thành viên");
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
                            <div class="card-header pb-0">
                                <div>
                                    <h4 id="before_title_lang">Before issuance of alien registration card (issued in Korea)</h4>
                                </div>
                                <br/>
                                <div>
                                    <p id="before_1_lang"> - Select the Prepaid Application Form menu from the menu and click the Register button</p>
                                    <div style="text-align:center; width:80%; margin:0 auto;">
                                        <img src="/img/tables/before_1.png" alt="Prepaid Plan" style="max-width: 100%; height: auto;">
                                        <img src="/img/tables/before_2.png" alt="Prepaid Plan" style="max-width: 100%; height: auto;">
                                    </div>
                                    <br/>
                                    <p id="before_2_lang"> - Select the applicable language and fill out the membership application form in the form provided</p>
                                    <div style="text-align:center; width:80%; margin:0 auto;">
                                        <img src="/img/tables/before_3.png" alt="Prepaid Plan" style="max-width: 100%; height: auto;">
                                    </div>
                                    <br/>
                                    <p id="before_3_lang"> - After completion of completion, if the Opening Status is Opening, you can edit the completed application</p>
                                    <div style="text-align:center; width:80%; margin:0 auto;">
                                        <img src="/img/tables/before_4.png" alt="Prepaid Plan" style="max-width: 100%; height: auto;">
                                    </div>
                                    <br/>
                                    <p id="before_4_lang"> - When proceeding with the KT subscription-related process, you can check the progress through the Prepaid Application Form menu</p>
                                    <p id="before_5_lang"> - Once the prepaid application is finalized, a notification email will be sent to the email address provided during membership registration</p>
                                    <div style="text-align:center; width:80%; margin:0 auto;">
                                        <img src="/img/tables/before_5.png" alt="Prepaid Plan" style="max-width: 100%; height: auto;">
                                    </div>
                                </div>
                            </div>
                            <hr/>
                            <div class="card-header pb-0">
                                <div>
                                    <h4 id="after_title_lang">After issuance of alien registration card (issued in Korea)</h4>
                                </div>
                                <br/>
                                <div>
                                    <p id="after_1_lang"> - Registration is only possible if you have received an email with instructions for signing up for the postpaid system</p>
                                    <div style="text-align:center; width:80%; margin:0 auto;">
                                        <img src="/img/tables/after_1.png" alt="Prepaid Plan" style="max-width: 100%; height: auto;">
                                    </div>
                                    <br/>
                                    <p id="after_2_lang"> - Select the Prepaid Application Form menu from the menu and click the Apply Click button in the Deferred Payment Status section of the completed prepaid subscription application history</p>
                                    <div style="text-align:center; width:80%; margin:0 auto;">
                                        <img src="/img/tables/after_2.png" alt="Prepaid Plan" style="max-width: 100%; height: auto;">
                                    </div>
                                    <br/>
                                    <p id="after_3_lang"> - Select the applicable language and register the Alien registration card in the form provided</p>
                                    <div style="text-align:center; width:80%; margin:0 auto;">
                                        <img src="/img/tables/after_3.png" alt="Prepaid Plan" style="max-width: 100%; height: auto;">
                                    </div>
                                    <br/>
                                    <p id="after_4_lang"> - When proceeding with the KT subscription-related process, you can check the progress through the Prepaid Application Form menu</p>
                                    <div style="text-align:center; width:80%; margin:0 auto;">
                                        <img src="/img/tables/after_4.png" alt="Prepaid Plan" style="max-width: 100%; height: auto;">
                                    </div>
                                    <br/>
                                    <p id="after_5_lang"> - Once the postpaid subscription application is finalized, a notification email will be sent to the email address provided during membership registration</p>
                                    <div style="text-align:center; width:80%; margin:0 auto;">
                                        <img src="/img/tables/after_5.png" alt="Prepaid Plan" style="max-width: 100%; height: auto;">
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
