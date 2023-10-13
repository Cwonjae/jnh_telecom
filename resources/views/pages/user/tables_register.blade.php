@extends('layouts.user.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    <script>
        $(function () {
            $('.js-signature').jqSignature();

            /**
             *  국가 입력시 자동완성 기능 추가
             * */
            const locList = ["Albania","Algeria","Afghanistan","Kabol","America","Angola","Antigua and Barbuda Armenia","Republic of Armenia","Australia","Azerbaijan","Bahrain","Barbados","Belarus","Belgium","Bolivia","Bosnia","Brazil","Bulgaria","Burundi","Cambodia","Cameroon","Canada","Central African Republic","Chad","Chile ", "China","Colombia","Croatia","Cuba","Cyprus","Czech","Denmark","Egypt","El Salvador","Eritrea","Estonia","Finland","France","Georgia","Germany","Greece","Hong Kong","China","Hungary","India","Indonesia","Iran","Iraq","ireland","Israel","Italy","Japan","Jordan","Kazakhstan","Kenya","Korea","Kuwait","Kyrgyzstan","Latvia","Republic of Latvia","Lebanon","Liberia","Libya","Lithuania","Macedonia","Madagascar","Malaysia","Malta","Mexico","Monaco","Mongolia ","Morocco","Karabakh","Nagorno","Karabakh","Namibia","Netherlands","arab","Nicaragua","Nigeria","Oman","Pakistan","Islamic Republic of Pakistan","Palestine","Panama","Peru","Philippines","Portugal","Qatar","Romania","Russia","Saudi Arabia","Serbia","Singapore","Slovakia","Slovenia","Somalia","South Africa","spain","Sri Lanka","Sudan","Sweden","Switzerland","Syria","Tajikistan","Tanzania","Thailand","See East Timor","Türkiye","Turkmenistan","Turks","Ukraine","United Arab Emirates","United Kingdom","Great Britain and Northern Ireland","United States America","Uzbekistan","Vatican City"];

            // input필드에 자동완성 기능을 걸어준다
            $('#inputSearch').autocomplete({
                source: locList,
                focus: function (event, ui) {
                    return false;
                },
                select: function (event, ui) {},
                minLength: 1,
                delay: 100,
                autoFocus: true,
            });

            $('#dateofbirth').keyup(function() {
                var val = $(this).val().replace(/[^0-9]/g, '');

                if(val.length < 11){
                    $(this).val(val.substring(0,2) + "-" + val.substring(2,4) + "-" + val.substring(4,8));
                }
            });
            

            $('.js-signature').on('jq.signature.changed', function() {
                $('#saveBtn').css('display', 'inline-block');
            });

            $('#form_submit').click(function() {
                formCheck();
            });

            $('#lang_check').change(function() {
                var value = $(this).val();
                switch(value) {
                    case 'english' :
                        $('#name_lang').text("");
                        $('#nationality_lang').text("");
                        $('#passportnumber_lang').text("");
                        $('#passport_lang').text("");
                        $('#deteofbirth_lang').text("");
                        $('#gender_lang').text("");
                        $('#imei_lang').text("");
                        $('#plan_lang').text("");
                        $('#choose_lang').text("");
                        $('#signature_lang').text("");
                        $('#referral_lang').text("");
                        $('#service_lang').text("");
                        $('#connectivity_lang').text("");
                        $('#signature_note').text("The signature you registered will be used on the Korean mobile communication subscription form.");
                        break;
                    case 'russian' :
                        $('#name_lang').text(" (Полное имя)");
                        $('#nationality_lang').text(" (Национальность)");
                        $('#passportnumber_lang').text(" (номер паспорта)");
                        $('#passport_lang').text(" (заграничный пасспорт)");
                        $('#deteofbirth_lang').text(" (Дата рождения)");
                        $('#gender_lang').text(" (пол)");
                        $('#imei_lang').text(" (номер imei)");
                        $('#plan_lang').text(" (план)");
                        $('#choose_lang').text(" (Пожалуйста, выберите последние четыре цифры вашего номера телефона (можно ввести до 3-х номеров))");
                        $('#signature_lang').text(" (подпись)");
                        $('#referral_lang').text(" (направления)");
                        $('#service_lang').text(" (услуга)");
                        $('#connectivity_lang').text(" (возможность подключения)");
                        $('#signature_note').text("Зарегистрированная вами подпись будет использоваться в форме подписки на мобильную связь в Корее.");
                        break;
                    case 'uzbek' :
                        $('#name_lang').text(" (to'liq ism)");
                        $('#nationality_lang').text(" (millati)");
                        $('#passportnumber_lang').text(" (pasport raqami)");
                        $('#passport_lang').text(" (pasport)");
                        $('#deteofbirth_lang').text(" (tug'ilgan kuni)");
                        $('#gender_lang').text(" (jins)");
                        $('#imei_lang').text(" (imei raqami)");
                        $('#plan_lang').text(" (reja)");
                        $('#choose_lang').text(" (Iltimos, telefon raqamingizning oxirgi to'rtta raqamini tanlang (3 tagacha element kiritilishi mumkin))");
                        $('#signature_lang').text(" (imzo)");
                        $('#referral_lang').text(" (murojaat)");
                        $('#service_lang').text(" (xizmat)");
                        $('#connectivity_lang').text(" (ulanish)");
                        $('#signature_note').text("Siz roʻyxatdan oʻtgan imzo Koreya mobil aloqasi obuna formasida qoʻllaniladi.");
                        break;
                    case 'tagalog' :
                        $('#name_lang').text(" (buong pangalan)");
                        $('#nationality_lang').text(" (nasyonalidad)");
                        $('#passportnumber_lang').text(" (numero ng pasaporte)");
                        $('#passport_lang').text(" (pasaporte)");
                        $('#deteofbirth_lang').text(" (araw ng kapanganakan)");
                        $('#gender_lang').text(" (kasarian)");
                        $('#imei_lang').text(" (numero ng imei)");
                        $('#plan_lang').text(" (plano)");
                        $('#choose_lang').text(" (Pakipili ang huling apat na digit ng iyong numero ng telepono (Hanggang 3 item ang maaaring ilagay))");
                        $('#signature_lang').text(" (pirma)");
                        $('#referral_lang').text(" (referral)");
                        $('#service_lang').text(" (serbisyo)");
                        $('#connectivity_lang').text(" (pagkakakonekta)");
                        $('#signature_note').text("Ang pirma na iyong inirehistro ay gagamitin sa Korean mobile communication na subscription form.");
                        break;
                    case 'vietnamese' :
                        $('#name_lang').text(" (Họ và tên)");
                        $('#nationality_lang').text(" (quốc tịch)");
                        $('#passportnumber_lang').text(" (số hộ chiếu)");
                        $('#passport_lang').text(" (hộ chiếu)");
                        $('#deteofbirth_lang').text(" (ngày sinh)");
                        $('#gender_lang').text(" (giới tính)");
                        $('#imei_lang').text(" (số imei)");
                        $('#plan_lang').text(" (kế hoạch)");
                        $('#choose_lang').text(" (Vui lòng chọn bốn chữ số cuối của số điện thoại của bạn (Có thể nhập tối đa 3 mục))");
                        $('#signature_lang').text(" (chữ ký)");
                        $('#referral_lang').text(" (giới thiệu)");
                        $('#service_lang').text(" (dịch vụ)");
                        $('#connectivity_lang').text(" (kết nối)");
                        $('#signature_note').text("Chữ ký bạn đã đăng ký sẽ được sử dụng trên mẫu đăng ký liên lạc di động của Hàn Quốc.");
                        break;
                    default :
                        break;
                }
            });
        });

        function formCheck() {
            var signature_img_length = $('#signature').find('#signature_img').length;
            if(signature_img_length == 0 || !signature_img_length) {
                alert('Please Use your mouse or finger to draw your signature above');
                return false;
            } else {
                $('#cellPhone_register').submit();
            }

        }

        function clearCanvas() {
            $('.js-signature').jqSignature('clearCanvas');
		    $('#saveBtn').css('display', 'none');
            $("#signature").empty();
        }

        function saveSignature() {
		    $('#signature').empty();
            var dataUrl = $('.js-signature').jqSignature('getDataURL');
            var img = $('<img id="signature_img">').attr('src', dataUrl);

            $('#signature').append(img);
            $('#signature_txt').val(dataUrl);
		    $('#signature_img').css('display', 'none');
            alert('Sign Saved Successfully');
        }

        function checkInputNum(){
            if ((event.keyCode < 48) || (event.keyCode > 57)){
                event.returnValue = false;
            }
        }

        function checkInputValue(_this){
            var value = $("#"+_this.id).val();
            var split_value = value.split(",");
            var val_add;

            if(val_split.length > 0 && val_split.length < 4) {
                if(val.length == 4) {
                    val_add = val + ",";
                    $("#"+_this.id).val(val_add);
                } else if(val.length == 9) {
                    val_add = val + ",";
                    $("#"+_this.id).val(val_add);
                }
            }
        }
    </script>

    @include('layouts.navbars.auth.user.topnav', ['title' => 'Olleh Mobile Application Form'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Olleh Mobile Application Form</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0" style="width:92%; margin:auto; margin-top:30px;">
                            <div class="flex flex-col mb-3">
                                <select class="lang_check" id="lang_check">
                                    <option value="english" selected>English</option>
                                    <option value="russian">Russian</option>
                                    <option value="uzbek">Uzbek</option>
                                    <option value="tagalog">Tagalog</option>
                                    <option value="vietnamese">Vietnamese</option>
                                </select>
                            </div>
                            <!-- <div class="flex flex-col mb-3">
                                <h4>Welcome to Korea!</h4>
                                <div>
                                    <img src="/img/tables/tables1.jpeg" alt="Korea City IMG" style="max-width: 100%; height: auto;">
                                    <img src="/img/tables/tables2.jpeg" alt="K-Telecom Introduction" style="max-width: 100%; height: auto;">
                                    <img src="/img/tables/tables3.png" alt="How to Save Big?" style="max-width: 100%; height: auto;">
                                </div>
                                <div>
                                    <h6>Limited-time Prepaid Plan Promotion - Enjoy an Initial top-up on Us!</h6>
                                    <span style="margin-left:30px;">᛫ Sign up for our Prepaid Plan and get the first top-up of 30,000 KRW ($23) from us!</span><br>
                                    <span style="margin-left:30px;">᛫ Your first top-up is our treat to you as part of this special promotion.</span><br>
                                    <span style="margin-left:30px;">᛫ After the initial top-up, you'll be responsible for future top-ups. Use the charged amount for services with a flexible validity period.</span><br>
                                    <span style="margin-left:30px;">᛫ Switch to Postpaid later and receive a bonus equivalent to your charged amount.</span><br>
                                    <span style="margin-left:30px;">᛫ We provide a cash deposit to your account for the exact amount you top-up.</span><br>
                                    <span style="margin-left:30px;">᛫ Your deposited funds match the amount you top up. Don't miss out on this fantastic offer!</span><br>
                                    <br>
                                    <span>Join our Prepaid Plan today and enjoy the convenience and flexibility of our services. </span><br>
                                    <span>After activating our prepaid service, if you switch to postpaid service using a foreigner registration card, we'll provide a 50,000 KRW ($38) subsidy towards your first bill. </span><br>
                                    <hr style="width:100%;">
                                    <span>The exchange rate applied is 1,300 KRW.</span>
                                </div>
                            </div> -->
                            
                            <form method="POST" action="{{ route('userpage.insert', ['page' => 'tables']) }}" id="cellPhone_register" enctype="multipart/form-data">
                            @csrf
                                <div class="flex flex-col mb-3">
                                    <h6 style="float:left;">Full Name <span style="color:red">*</span></h6><h4 id="name_lang"></h4>
                                    <input type="text" name="applicant" class="form-control" placeholder="Your Full Name" aria-label="Name" value="{{ old('applicant') }}" id="applicant">
                                    @error('applicant') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <h6 style="float:left;">Nationality <span style="color:red">*</span></h6><h4 id="nationality_lang"></h4>
                                    <input type="text" name="nationality" class="form-control" placeholder="Nationality" aria-label="Nationality" value="{{ old('nationality') }}" autocomplete="off" id="inputSearch">
                                    @error('nationality') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <h6 style="float:left;">Passport Number <span style="color:red">*</span></h6><h4 id="passportnumber_lang"></h4>
                                    <input type="text" name="passportnumber" class="form-control" aria-label="PassportNumber" id="passportnumber" placeholder="Your PassPort Number" >
                                    @error('passportnumber') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <h6 style="float:left;">Passport <span style="color:red">*</span></h6><h4 id="passport_lang"></h4>
                                    <input type="file" name="passport" accept="file_extension,image/*" capture="camera" class="form-control" aria-label="Passport" id="passport">
                                    @error('passport') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <h6 style="float:left;">Date Of Birth <span style="color:red">*</span></h6><h4 id="deteofbirth_lang"></h4>
                                    <input type="text" name="dateofbirth" class="form-control" placeholder="MM-DD-YYYY" aria-label="Date Of Birth" value="{{ old('dateofbirth') }}" id="dateofbirth" maxlength="11">
                                    @error('dateofbirth') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="form-radio form-check-info text-start">
                                    <h6 style="float:left;">Gender <span style="color:red">*</span></h6><h4 id="gender_lang"></h4>
                                    <input class="form-radio-input" type="radio" name="gender" id="flexRadioDefault_m" value="male">
                                    <label class="form-radio-label" for="flexRadioDefault_m">Male</label>
                                    <input class="form-radio-input" type="radio" name="gender" id="flexRadioDefault_f" value="female">
                                    <label class="form-radio-label" for="flexRadioDefault_f">FeMale</label>
                                    @error('gender') <p class='text-danger text-xs'> {{ $message }} </p> @enderror
                                </div>
                                <!-- <div class="form-radio form-check-info text-start">
                                    <h6>Device <span style="color:red">*</span></h6>
                                    <input class="form-radio-input" type="radio" name="device" id="flexRadioDefault_ap" value="apple">
                                    <label class="form-radio-label" for="flexRadioDefault_ap">Apple</label>
                                    <input class="form-radio-input" type="radio" name="device" id="flexRadioDefault_s" value="samsung">
                                    <label class="form-radio-label" for="flexRadioDefault_s">Samsung</label>
                                    <input class="form-radio-input" type="radio" name="device" id="flexRadioDefault_o" value="other">
                                    <label class="form-radio-label" for="flexRadioDefault_o">Other</label>
                                    @error('device') <p class='text-danger text-xs'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <h6>Device Model <span style="color:red">*</span></h6>
                                    <input type="text" name="devicemodel" class="form-control" placeholder="Ex) Iphone 13, Iphone 13 mini, Galaxy S22, etc" aria-label="Device Model" value="{{ old('devicemodel') }}" id="devicemodel">
                                    @error('devicemodel') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <h6>OS Version <span style="color:red">*</span></h6>
                                    <input type="text" name="osversion" class="form-control" placeholder="Ex) Android Version 13, IOS version 16.5, etc" aria-label="Os Version" value="{{ old('osversion') }}" id="osversion">
                                    @error('osversion') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div> -->
                                <div class="flex flex-col mb-3">
                                    <img src="/img/tables/tables4.png" alt="IMEI and S/N" style="max-width: 100%; height: auto;">
                                    <p>Dial *#06# or go to setting - about to find IMEI number.</p>
                                </div>
                                <div class="flex flex-col mb-3">
                                    <h6 style="float:left;">IMEI Number <span style="color:red">*</span></h6><h4 id="imei_lang"></h4>
                                    <input type="text" name="imeinumber" class="form-control" placeholder="IMEI Number" aria-label="IMEI Number" value="{{ old('imeinumber') }}" id="imeinumber">
                                    @error('imeinumber') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <p>[Prepaid Plan]</p>
                                    <img src="/img/tables/tables5.png" alt="Prepaid Plan" style="max-width: 100%; height: auto;"><br>
                                    <span style="margin-left:30px;">᛫ Prepaid Plan: Use charged amount for services.</span><br>
                                    <span style="margin-left:30px;">᛫ Validity: Depends on recharge amount, balance expires after.</span><br>
                                    <span style="margin-left:30px;">᛫ No refunds or cancellations available.</span><br>
                                    <span style="margin-left:30px;">᛫ During validity: Use remaining balance.</span><br>
                                    <span style="margin-left:30px;">᛫ After validity: Outgoing calls restricted, then 14 days incoming only, 30 days both suspended, then automatic termination.</span><br>
                                    <span style="margin-left:30px;">᛫ Recharge within validity extends period (max 2 years).</span><br>
                                    <span style="margin-left:30px;">᛫ Some benefits don't accumulate (e.g., KT mobile-to-mobile calls).</span><br>
                                    <span style="margin-left:30px;">᛫ No discounts, points, memberships, rentals, roaming, and specific services.</span><br>
                                    <span style="margin-left:30px;">᛫ Switching won't transfer balances or provide refunds.</span><br>
                                    <span style="margin-left:30px;">᛫ Postpaid to prepaid: Benefits won't transfer.</span><br>
                                    <span style="margin-left:30px;">᛫ Cancelling prepaid after switching: No refund for charged amount.</span>
                                </div>
                                <div class="form-radio form-check-info text-start">
                                    <h6 style="float:left;">Plan <span style="color:red">*</span></h6><h4 id="plan_lang"></h4>
                                    <input class="form-radio-input" type="radio" name="plan" id="flexRadioDefault_p" value="ok">
                                    <label class="form-radio-label" for="flexRadioDefault_p">30,000 KRW($23)</label>
                                    <p>Please note that devices purchased from the United States may not be compatible with our 5G plan.</p>
                                    @error('plan') <p class='text-danger text-xs'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <h6>Please choose the last four digits of your phone number (Up to 3 items can be entered) </h6><h4 id="choose_lang"></h4>
                                    <input type="text" name="chooselastnumber" class="form-control" placeholder="Please choose the last four digits of your phone number." aria-label="Please choose the last four digits of your phone number." value="{{ old('chooselastnumber') }}" onKeyPress="javascript:checkInputNum();" onKeyUp="javascript:checkInputValue(this);" maxlength="14" id="chooselastnumber">
                                    @error('chooselastnumber') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                    <p>If the phone number you have chosen is already taken, please note that it can be activated with different last four digits.</p>
                                </div>
                                <div class="flex flex-col mb-3">
                                    <h6 style="float:left;">Signature <span style="color:red">*</span></h6><h4 id="signature_lang"></h4>
                                    <div class='js-signature'></div>
                                    <a id="clearBtn" class="btn btn-default" onclick="clearCanvas();">Clear Canvas</a>
                                    <a id="saveBtn" class="btn btn-default" onclick="saveSignature();" style="display:none;">Save Signature</a>
                                    <p>Use your mouse or finger to draw your signature above</p>
                                    <p id="signature_note" style="color:red">The signature you registered will be used on the Korean mobile communication subscription form.</p>
                                    @error('signaturetxt') <p class='text-danger text-xs'> {{ $message }} </p> @enderror
                                    <input type="hidden" id="signature_txt" name="signaturetxt" value="{{ old('signaturetxt') }}"/>
                                    <div id="signature"></div>
                                </div>
                                <div class="flex flex-col mb-3">
                                    <h6 style="float:left;">Referral </h6><h4 id="referral_lang"></h4>
                                    <input type="text" name="referral" class="form-control" placeholder="Please enter the referral's email address, phone number and name" aria-label="Referral" value="{{ old('referral') }}" id="referral">
                                    @error('referral') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <!-- <div class="form-radio form-check-info text-start">
                                    <h6>Add International Calling Service <span style="color:red">*</span></h6>
                                    <input class="form-radio-input" type="radio" name="callservice" id="flexRadioDefault_y" value="yes">
                                    <label class="form-radio-label" for="flexRadioDefault_y">Yes</label>
                                    <input class="form-radio-input" type="radio" name="callservice" id="flexRadioDefault_n" value="no">
                                    <label class="form-radio-label" for="flexRadioDefault_n">No</label>
                                    @error('callservice') <p class='text-danger text-xs'> {{ $message }} </p> @enderror
                                    <p>Extra $5/ month per line</p>
                                </div> -->
                                <div class="flex flex-col mb-3">
                                    <img src="/img/tables/tables6.png" alt="5G" style="max-width: 100%; height: auto;">
                                    <img src="/img/tables/tables7.png" alt="4G" style="max-width: 100%; height: auto;">
                                </div>
                                <div class="form-radio form-check-info text-start">
                                    <h6 style="float:left;">Service <span style="color:red">*</span></h6><h4 id="service_lang"></h4>
                                    <input class="form-radio-input" type="radio" name="service" id="flexRadioDefault_ag" value="annual_agreement">
                                    <label class="form-radio-label" for="flexRadioDefault_ag">Annual Agreement (25% discount)</label>
                                    <input class="form-radio-input" type="radio" name="service" id="flexRadioDefault_mp" value="monthly_plan">
                                    <label class="form-radio-label" for="flexRadioDefault_mp">Monthly Plan</label>
                                    @error('service') <p class='text-danger text-xs'> {{ $message }} </p> @enderror
                                </div>
                                <div class="form-radio form-check-info text-start">
                                    <h6 style="float:left;">Connectivity <span style="color:red">*</span></h6><h4 id="connectivity_lang"></h4>
                                    <input class="form-radio-input" type="radio" name="connectivity" id="flexRadioDefault_4g" value="4g">
                                    <label class="form-radio-label" for="flexRadioDefault_4g">4G</label>
                                    <input class="form-radio-input" type="radio" name="connectivity" id="flexRadioDefault_5g" value="5g">
                                    <label class="form-radio-label" for="flexRadioDefault_5g">5G</label>
                                    @error('connectivity') <p class='text-danger text-xs'> {{ $message }} </p> @enderror
                                </div>
                            </form>

                            <div class="text-center">
                                    <a class="btn bg-gradient-dark w-100 my-4 mb-2" id="form_submit">Submit Form</a>
                            </div>
                            <div id="alert">
                                @include('components.alert')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.user.footer')
    </div>
@endsection
