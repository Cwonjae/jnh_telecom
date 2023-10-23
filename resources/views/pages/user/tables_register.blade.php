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
                if(event.keyCode == 8) {
                    $(this).val();
                } else {
                    var val = $(this).val().replace(/[^0-9]/g, '');

                    if(val.length < 3) {
                        $(this).val(val.substring(0,2) + "-");
                    } else if(val.length >= 3 && val.length < 5) {
                        $(this).val(val.substring(0,2) + "-" + val.substring(2,4) + "-");
                    } else if(val.length > 5) {
                        $(this).val(val.substring(0,2) + "-" + val.substring(2,4) + "-" + val.substring(4,8));
                    } else {
                        $(this).val(val.substring(0,2) + "-" + val.substring(2,4) + "-" + val.substring(4,8));
                    }
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
                        $('#name_lang').html("Full Name <span style='color:red'>*</span>");
                        $('#nationality_lang').html("Nationality <span style='color:red'>*</span>");
                        $('#passportnumber_lang').html("Passport Number <span style='color:red'>*</span>");
                        $('#passport_lang').html("Passport <span style='color:red'>*</span>");
                        $('#deteofbirth_lang').html("Dete of Birth <span style='color:red'>*</span>");
                        $('#gender_lang').html("Gender <span style='color:red'>*</span>");
                        $('#device_lang').html("Device <span style='color:red'>*</span>");
                        $('#devicemodel_lang').html("Device Model <span style='color:red'>*</span>");
                        $('#osversion_lang').html("OS Version <span style='color:red'>*</span>");
                        $('#imei_lang').html("IMEI Number <span style='color:red'>*</span>");
                        $('#plan_lang').html("Plan <span style='color:red'>*</span>");
                        $('#choose_lang').html("Please choose the last four digits of your phone number (Up to 3 items can be entered) ");
                        $('#signature_lang').html("Signature <span style='color:red'>*</span>");
                        $('#referral_lang').html("Referral ");
                        $('#service_lang').html("Service <span style='color:red'>*</span>");
                        $('#connectivity_lang').html("Connectivity <span style='color:red'>*</span>");
                        $('#signature_note').text("The signature you registered will be used on the Korean mobile communication subscription form.");
                        break;
                    case 'russian' :
                        $('#name_lang').html("Полное имя <span style='color:red'>*</span>");
                        $('#nationality_lang').html("Национальность <span style='color:red'>*</span>");
                        $('#passportnumber_lang').html("номер паспорта <span style='color:red'>*</span>");
                        $('#passport_lang').html("заграничный пасспорт <span style='color:red'>*</span>");
                        $('#deteofbirth_lang').html("Дата рождения <span style='color:red'>*</span>");
                        $('#gender_lang').html("пол <span style='color:red'>*</span>");
                        $('#device_lang').html("устройство <span style='color:red'>*</span>");
                        $('#devicemodel_lang').html("модель устройства <span style='color:red'>*</span>");
                        $('#osversion_lang').html("версия ОС <span style='color:red'>*</span>");
                        $('#imei_lang').html("номер imei <span style='color:red'>*</span>");
                        $('#plan_lang').html("план <span style='color:red'>*</span>");
                        $('#choose_lang').html("Пожалуйста, выберите последние четыре цифры вашего номера телефона (можно ввести до 3-х номеров) ");
                        $('#signature_lang').html("подпись <span style='color:red'>*</span>");
                        $('#referral_lang').html("направления ");
                        $('#service_lang').html("услуга <span style='color:red'>*</span>");
                        $('#connectivity_lang').html("возможность подключения <span style='color:red'>*</span>");
                        $('#signature_note').text("Зарегистрированная вами подпись будет использоваться в форме подписки на мобильную связь в Корее.");
                        break;
                    case 'uzbek' :
                        $('#name_lang').html("to'liq ism <span style='color:red'>*</span>");
                        $('#nationality_lang').html("millati <span style='color:red'>*</span>");
                        $('#passportnumber_lang').html("pasport raqami <span style='color:red'>*</span>");
                        $('#passport_lang').html("pasport <span style='color:red'>*</span>");
                        $('#deteofbirth_lang').html("tug'ilgan kuni <span style='color:red'>*</span>");
                        $('#gender_lang').html("jins <span style='color:red'>*</span>");
                        $('#device_lang').html("qurilma <span style='color:red'>*</span>");
                        $('#devicemodel_lang').html("qurilma modeli <span style='color:red'>*</span>");
                        $('#osversion_lang').html("os versiyasi <span style='color:red'>*</span>");
                        $('#imei_lang').html("imei raqami <span style='color:red'>*</span>");
                        $('#plan_lang').html("reja <span style='color:red'>*</span>");
                        $('#choose_lang').html("Iltimos, telefon raqamingizning oxirgi to'rtta raqamini tanlang (3 tagacha element kiritilishi mumkin) ");
                        $('#signature_lang').html("imzo <span style='color:red'>*</span>");
                        $('#referral_lang').html("murojaat ");
                        $('#service_lang').html("xizmat <span style='color:red'>*</span>");
                        $('#connectivity_lang').html("ulanish <span style='color:red'>*</span>");
                        $('#signature_note').text("Siz roʻyxatdan oʻtgan imzo Koreya mobil aloqasi obuna formasida qoʻllaniladi.");
                        break;
                    case 'tagalog' :
                        $('#name_lang').html("buong pangalan <span style='color:red'>*</span>");
                        $('#nationality_lang').html("nasyonalidad <span style='color:red'>*</span>");
                        $('#passportnumber_lang').html("numero ng pasaporte <span style='color:red'>*</span>");
                        $('#passport_lang').html("pasaporte <span style='color:red'>*</span>");
                        $('#deteofbirth_lang').html("araw ng kapanganakan <span style='color:red'>*</span>");
                        $('#gender_lang').html("kasarian <span style='color:red'>*</span>");
                        $('#device_lang').html("aparato <span style='color:red'>*</span>");
                        $('#devicemodel_lang').html("modelo ng device <span style='color:red'>*</span>");
                        $('#osversion_lang').html("bersyon ng os <span style='color:red'>*</span>");
                        $('#imei_lang').html("numero ng imei <span style='color:red'>*</span>");
                        $('#plan_lang').html("plano <span style='color:red'>*</span>");
                        $('#choose_lang').html("Pakipili ang huling apat na digit ng iyong numero ng telepono (Hanggang 3 item ang maaaring ilagay) ");
                        $('#signature_lang').html("pirma <span style='color:red'>*</span>");
                        $('#referral_lang').html("referral ");
                        $('#service_lang').html("serbisyo <span style='color:red'>*</span>");
                        $('#connectivity_lang').html("pagkakakonekta <span style='color:red'>*</span>");
                        $('#signature_note').text("Ang pirma na iyong inirehistro ay gagamitin sa Korean mobile communication na subscription form.");
                        break;
                    case 'vietnamese' :
                        $('#name_lang').html("Họ và tên <span style='color:red'>*</span>");
                        $('#nationality_lang').html("quốc tịch <span style='color:red'>*</span>");
                        $('#passportnumber_lang').html("số hộ chiếu <span style='color:red'>*</span>");
                        $('#passport_lang').html("hộ chiếu <span style='color:red'>*</span>");
                        $('#deteofbirth_lang').html("ngày sinh <span style='color:red'>*</span>");
                        $('#gender_lang').html("giới tính <span style='color:red'>*</span>");
                        $('#device_lang').html("thiết bị <span style='color:red'>*</span>");
                        $('#devicemodel_lang').html("mô hình thiết bị <span style='color:red'>*</span>");
                        $('#osversion_lang').html("phiên bản của hệ điều hành <span style='color:red'>*</span>");
                        $('#imei_lang').html("số imei <span style='color:red'>*</span>");
                        $('#plan_lang').html("kế hoạch <span style='color:red'>*</span>");
                        $('#choose_lang').html("Vui lòng chọn bốn chữ số cuối của số điện thoại của bạn (Có thể nhập tối đa 3 mục) ");
                        $('#signature_lang').html("chữ ký <span style='color:red'>*</span>");
                        $('#referral_lang').html("giới thiệu ");
                        $('#service_lang').html("dịch vụ <span style='color:red'>*</span>");
                        $('#connectivity_lang').html("kết nối <span style='color:red'>*</span>");
                        $('#signature_note').text("Chữ ký bạn đã đăng ký sẽ được sử dụng trên mẫu đăng ký liên lạc di động của Hàn Quốc.");
                        break;
                    default :
                        break;
                }
            });
        });

        function formCheck() {
            var signature_img_length = $('#signature').find('#signature_img').length;
            var checked = $('#consent').is(':checked');

            if(signature_img_length == 0 || !signature_img_length) {
                alert('Please Use your mouse or finger to draw your signature above');
                return false;
            } else if(!checked) { 
                alert('Please check your consent to use the sign');
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

            if(split_value.length > 0 && split_value.length < 4) {
                if(value.length == 4) {
                    val_add = value + ",";
                    $("#"+_this.id).val(val_add);
                } else if(value.length == 9) {
                    val_add = value + ",";
                    $("#"+_this.id).val(val_add);
                }
            }
        }
    </script>

    @include('layouts.navbars.auth.user.topnav', ['title' => 'Olleh Prepaid Application Form'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Olleh Prepaid Application Form</h6>
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
                            
                            <form method="POST" action="{{ route('userpage.insert', ['page' => 'tables']) }}" id="cellPhone_register" enctype="multipart/form-data">
                            @csrf
                                <div class="flex flex-col mb-3">
                                    <h6 id="name_lang">Full Name <span style="color:red">*</span></h6>
                                    <input type="text" name="applicant" class="form-control" placeholder="Your Full Name" aria-label="Name" value="{{ old('applicant') }}" id="applicant">
                                    @error('applicant') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <h6 id="nationality_lang">Nationality <span style="color:red">*</span></h6>
                                    <input type="text" name="nationality" class="form-control" placeholder="Nationality" aria-label="Nationality" value="{{ old('nationality') }}" autocomplete="off" id="inputSearch">
                                    @error('nationality') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <h6 id="passportnumber_lang">Passport Number <span style="color:red">*</span></h6>
                                    <input type="text" name="passportnumber" class="form-control" aria-label="PassportNumber" id="passportnumber" placeholder="Your PassPort Number" >
                                    @error('passportnumber') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <h6 id="passport_lang">Passport <span style="color:red">*</span></h6>
                                    <input type="file" name="passport" accept="file_extension,image/*" capture="camera" class="form-control" aria-label="Passport" id="passport">
                                    @error('passport') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <h6 id="deteofbirth_lang">Date Of Birth <span style="color:red">*</span></h6>
                                    <input type="text" name="dateofbirth" class="form-control" placeholder="MM-DD-YYYY" aria-label="Date Of Birth" value="{{ old('dateofbirth') }}" id="dateofbirth" maxlength="11">
                                    @error('dateofbirth') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="form-radio form-check-info text-start">
                                    <h6 id="gender_lang">Gender <span style="color:red">*</span></h6>
                                    <input class="form-radio-input" type="radio" name="gender" id="flexRadioDefault_m" value="male">
                                    <label class="form-radio-label" for="flexRadioDefault_m">Male</label>
                                    <input class="form-radio-input" type="radio" name="gender" id="flexRadioDefault_f" value="female">
                                    <label class="form-radio-label" for="flexRadioDefault_f">FeMale</label>
                                    @error('gender') <p class='text-danger text-xs'> {{ $message }} </p> @enderror
                                </div>
                                <div class="form-radio form-check-info text-start">
                                    <h6 id="device_lang">Device <span style="color:red">*</span></h6>
                                    <input class="form-radio-input" type="radio" name="device" id="flexRadioDefault_ap" value="apple">
                                    <label class="form-radio-label" for="flexRadioDefault_ap">Apple</label>
                                    <input class="form-radio-input" type="radio" name="device" id="flexRadioDefault_s" value="samsung">
                                    <label class="form-radio-label" for="flexRadioDefault_s">Samsung</label>
                                    <input class="form-radio-input" type="radio" name="device" id="flexRadioDefault_o" value="other">
                                    <label class="form-radio-label" for="flexRadioDefault_o">Other</label>
                                    @error('device') <p class='text-danger text-xs'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <h6 id="devicemodel_lang">Device Model <span style="color:red">*</span></h6>
                                    <input type="text" name="devicemodel" class="form-control" placeholder="Ex) Iphone 13, Iphone 13 mini, Galaxy S22, etc" aria-label="Device Model" value="{{ old('devicemodel') }}" id="devicemodel">
                                    @error('devicemodel') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <h6 id="osversion_lang">OS Version <span style="color:red">*</span></h6>
                                    <input type="text" name="osversion" class="form-control" placeholder="Ex) Android Version 13, IOS version 16.5, etc" aria-label="Os Version" value="{{ old('osversion') }}" id="osversion">
                                    @error('osversion') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <img src="/img/tables/tables4.png" alt="IMEI and S/N" style="max-width: 100%; height: auto;">
                                    <p>Dial *#06# or go to setting - about to find IMEI number.</p>
                                </div>
                                <div class="flex flex-col mb-3">
                                    <h6 id="imei_lang">IMEI Number <span style="color:red">*</span></h6>
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
                                    <h6 id="plan_lang">Plan <span style="color:red">*</span></h6>
                                    <input class="form-radio-input" type="radio" name="plan" id="flexRadioDefault_p" value="ok">
                                    <label class="form-radio-label" for="flexRadioDefault_p">30,000 KRW($23)</label>
                                    <p>Please note that devices purchased from the United States may not be compatible with our 5G plan.</p>
                                    @error('plan') <p class='text-danger text-xs'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <h6 id="choose_lang">Please choose the last four digits of your phone number (Up to 3 items can be entered) </h6>
                                    <input type="text" name="chooselastnumber" class="form-control" placeholder="Please choose the last four digits of your phone number." aria-label="Please choose the last four digits of your phone number." value="{{ old('chooselastnumber') }}" onKeyPress="javascript:checkInputNum();" onKeyUp="javascript:checkInputValue(this);" maxlength="14" id="chooselastnumber">
                                    @error('chooselastnumber') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                    <p>If the phone number you have chosen is already taken, please note that it can be activated with different last four digits.</p>
                                </div>
                                <div class="flex flex-col mb-3">
                                    <h6 id="signature_lang">Signature <span style="color:red">*</span></h6>
                                    <div class='js-signature'></div>
                                    <a id="clearBtn" class="btn btn-default" onclick="clearCanvas();">Clear Canvas</a>
                                    <a id="saveBtn" class="btn btn-default" onclick="saveSignature();" style="display:none;">Save Signature</a>
                                    <p>Use your mouse or finger to draw your signature above</p>
                                    <input type="checkbox" id="consent" name="consent" />
                                    <label for="consent">Consent</label>
                                    <p id="signature_note" style="color:red">The signature you registered will be used on the Korean mobile communication subscription form.</p>
                                    @error('signaturetxt') <p class='text-danger text-xs'> {{ $message }} </p> @enderror
                                    <input type="hidden" id="signature_txt" name="signaturetxt" value="{{ old('signaturetxt') }}"/>
                                    <div id="signature"></div>
                                </div>
                                <div class="flex flex-col mb-3">
                                    <h6 id="referral_lang">Referral </h6>
                                    <input type="text" name="referral" class="form-control" placeholder="Please enter the referral's email address, phone number and name" aria-label="Referral" value="{{ old('referral') }}" id="referral">
                                    @error('referral') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <img src="/img/tables/tables6.png" alt="5G" style="max-width: 100%; height: auto;">
                                    <img src="/img/tables/tables7.png" alt="4G" style="max-width: 100%; height: auto;">
                                </div>
                                <div class="form-radio form-check-info text-start">
                                    <h6 id="service_lang">Service <span style="color:red">*</span></h6>
                                    <input class="form-radio-input" type="radio" name="service" id="flexRadioDefault_ag" value="annual_agreement">
                                    <label class="form-radio-label" for="flexRadioDefault_ag">Annual Agreement (25% discount)</label>
                                    <input class="form-radio-input" type="radio" name="service" id="flexRadioDefault_mp" value="monthly_plan">
                                    <label class="form-radio-label" for="flexRadioDefault_mp">Monthly Plan</label>
                                    @error('service') <p class='text-danger text-xs'> {{ $message }} </p> @enderror
                                </div>
                                <div class="form-radio form-check-info text-start">
                                    <h6 id="connectivity_lang">Connectivity <span style="color:red">*</span></h6>
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
