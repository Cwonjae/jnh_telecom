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
                        $('#dontcheck_lang').text("Don't have a history of applying for Prepaid Application Form");
                        break;
                    case 'russian' :
                        $('#title_lang').text("Руководство по предоплаченной форме");
                        $('#before_title_lang').text("До выдачи регистрационной карты иностранца (выданной в Корее)");
                        $('#before_1_lang').text("Выберите в меню пункт «Форма предоплаченной заявки» и нажмите кнопку «Зарегистрироваться».");
                        $('#before_2_lang').text("Выберите подходящий язык и заполните форму заявки на членство в предоставленной форме.");
                        $('#before_3_lang').text("После завершения оформления, если Статус открытия — «Открывается», вы можете редактировать заполненную заявку.");
                        $('#before_4_lang').text("Приступая к процессу, связанному с подпиской KT, вы можете проверить ход выполнения через меню формы предоплаченной заявки.");
                        $('#before_5_lang').text("Как только предоплаченная заявка будет завершена, на адрес электронной почты, указанный при регистрации членства, будет отправлено уведомление");
                        break;
                    case 'uzbek' :
                        $('#title_lang').text("Oldindan to'langan shakl qo'llanma hujjatlari");
                        $('#before_title_lang').text("Chet ellik ro'yxatga olish kartasini berishdan oldin (Koreyada berilgan)");
                        $('#before_1_lang').text("Menyudan Oldindan to'langan ariza shakli menyusini tanlang va Ro'yxatdan o'tish tugmasini bosing");
                        $('#before_2_lang').text("Tegishli tilni tanlang va taqdim etilgan shaklda a'zolik ariza shaklini to'ldiring");
                        $('#before_3_lang').text("Tugallash tugallangandan so'ng, agar Ochilish holati ochilmoqda bo'lsa, siz tugallangan arizani tahrirlashingiz mumkin");
                        $('#before_4_lang').text("KT obunasi bilan bog'liq jarayonni davom ettirayotganda, siz oldindan to'langan ariza shakli menyusi orqali jarayonni tekshirishingiz mumkin");
                        $('#before_5_lang').text("Oldindan toʻlangan ariza yakunlangandan soʻng, aʼzolikni roʻyxatdan oʻtkazishda koʻrsatilgan elektron pochta manziliga xabarnoma yuboriladi");
                        break;
                    case 'tagalog' :
                        $('#title_lang').text("Prepaid Form Guide Documents");
                        $('#before_title_lang').text("Bago mag-isyu ng alien registration card (ibinigay sa Korea)");
                        $('#before_1_lang').text("Piliin ang Prepaid Application Form menu mula sa menu at i-click ang Register button");
                        $('#before_2_lang').text("Piliin ang naaangkop na wika at punan ang form ng aplikasyon ng membership sa ibinigay na form");
                        $('#before_3_lang').text("Matapos makumpleto ang pagkumpleto, kung ang Katayuan ng Pagbubukas ay Pagbubukas, maaari mong i-edit ang nakumpletong aplikasyon");
                        $('#before_4_lang').text("Kapag nagpapatuloy sa prosesong nauugnay sa subscription sa KT, maaari mong tingnan ang progreso sa pamamagitan ng menu ng Prepaid Application Form");
                        $('#before_5_lang').text("Kapag natapos na ang prepaid na aplikasyon, ipapadala ang isang email ng notification sa email address na ibinigay sa panahon ng pagpaparehistro ng membership");
                        break;
                    case 'vietnamese' :
                        $('#title_lang').text("Tài liệu hướng dẫn biểu mẫu trả trước");
                        $('#before_title_lang').text("Trước khi cấp thẻ đăng ký người nước ngoài (được cấp tại Hàn Quốc)");
                        $('#before_1_lang').text("Chọn menu Mẫu đơn đăng ký trả trước từ menu và nhấp vào nút Đăng ký");
                        $('#before_2_lang').text("Chọn ngôn ngữ áp dụng và điền vào mẫu đơn đăng ký thành viên theo mẫu được cung cấp");
                        $('#before_3_lang').text("Sau khi hoàn thành, nếu Trạng thái mở là Đang mở, bạn có thể chỉnh sửa ứng dụng đã hoàn thành");
                        $('#before_4_lang').text("Khi tiến hành quy trình liên quan đến đăng ký KT, bạn có thể kiểm tra tiến trình thông qua menu Mẫu đơn đăng ký trả trước");
                        $('#before_5_lang').text("Sau khi đơn đăng ký trả trước được hoàn tất, một email thông báo sẽ được gửi đến địa chỉ email được cung cấp trong quá trình đăng ký thành viên");
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
