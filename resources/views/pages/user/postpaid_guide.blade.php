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
                        $('#postpaid_1_lang').text("Select the Postpaid Application form menu from the menu and click the Register button.");
                        $('#postpaid_2_lang').text("Select the applicable language and fill out the membership application form in the form provided");
                        $('#postpaid_3_lang').text("When completed properly, you can check the Deferred Payment Status on the Postpaid Application Form page");
                        $('#postpaid_4_lang').text("Once the postpaid application is finalized, a notification email will be sent to the email address provided during membership registration");
                        break;
                    case 'russian' :
                        $('#title_lang').text("Руководство по формам постоплаты");
                        break;
                    case 'uzbek' :
                        $('#title_lang').text("Postpaid shakli uchun qo'llanma hujjatlari");
                        break;
                    case 'tagalog' :
                        $('#title_lang').text("Postpaid Form Guide Documents");
                        break;
                    case 'vietnamese' :
                        $('#title_lang').text("Tài liệu hướng dẫn biểu mẫu trả sau");
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
                                            <img src="/img/tables/postpaid_1.png" alt="Prepaid Plan" style="max-width: 100%; height: auto;">
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
