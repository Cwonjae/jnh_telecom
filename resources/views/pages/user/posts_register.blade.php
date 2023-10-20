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
                        $('#name_lang').text(" ");
                        $('#nationality_lang').text(" ");
                        $('#registration_card_lang').text(" ");
                        $('#deteofbirth_lang').text(" ");
                        $('#gender_lang').text(" ");
                        $('#imei_lang').text(" ");
                        $('#plan_lang').text(" ");
                        $('#choose_lang').text(" ");
                        $('#signature_lang').text(" ");
                        $('#referral_lang').text(" ");
                        $('#service_lang').text(" ");
                        $('#connectivity_lang').text(" ");
                        $('#signature_note').text("The signature you registered will be used on the Korean mobile communication subscription form.");
                        break;
                    case 'russian' :
                        $('#name_lang').text(" (Полное имя)");
                        $('#nationality_lang').text(" (Национальность)");
                        $('#registration_card_lang').text(" Регистрационная карта иностранца (выдана в Корее)");
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
                        $('#registration_card_lang').text(" Chet ellik ro'yxatga olish kartasi (Koreyada berilgan)");
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
                        $('#registration_card_lang').text(" Alien registration card (ibinigay sa Korea)");
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
                        $('#registration_card_lang').text(" Thẻ đăng ký người nước ngoài (được cấp tại Hàn Quốc)");
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
                            
                            <form method="POST" action="{{ route('userpage.insert', ['page' => 'posts']) }}" id="cellPhone_register" enctype="multipart/form-data">
                            @csrf
                                <div class="flex flex-col mb-3">
                                    <h6 style="float:left;">Full Name <span style="color:red">*</span></h6><h4 id="name_lang"> </h4>
                                    <input type="text" name="applicant" class="form-control" placeholder="Your Full Name" aria-label="Name" value="{{ old('applicant') }}" id="applicant">
                                    @error('applicant') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <h6 style="float:left;">Nationality <span style="color:red">*</span></h6><h4 id="nationality_lang"> </h4>
                                    <input type="text" name="nationality" class="form-control" placeholder="Nationality" aria-label="Nationality" value="{{ old('nationality') }}" autocomplete="off" id="inputSearch">
                                    @error('nationality') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <h6 style="float:left;">Alien registration card (issued in Korea) <span style="color:red">*</span></h6><h4 id="registration_card_lang"> </h4>
                                    <input type="file" name="registration_card" accept="file_extension,image/*" capture="camera" class="form-control" aria-label="Registration Card" id="registration_card">
                                    @error('registration_card') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <h6 style="float:left;">Date Of Birth <span style="color:red">*</span></h6><h4 id="deteofbirth_lang"> </h4>
                                    <input type="text" name="dateofbirth" class="form-control" placeholder="MM-DD-YYYY" aria-label="Date Of Birth" value="{{ old('dateofbirth') }}" id="dateofbirth" maxlength="11">
                                    @error('dateofbirth') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="form-radio form-check-info text-start">
                                    <h6 style="float:left;">Gender <span style="color:red">*</span></h6><h4 id="gender_lang"> </h4>
                                    <input class="form-radio-input" type="radio" name="gender" id="flexRadioDefault_m" value="male">
                                    <label class="form-radio-label" for="flexRadioDefault_m">Male</label>
                                    <input class="form-radio-input" type="radio" name="gender" id="flexRadioDefault_f" value="female">
                                    <label class="form-radio-label" for="flexRadioDefault_f">FeMale</label>
                                    @error('gender') <p class='text-danger text-xs'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <img src="/img/tables/tables4.png" alt="IMEI and S/N" style="max-width: 100%; height: auto;">
                                    <p>Dial *#06# or go to setting - about to find IMEI number.</p>
                                </div>
                                <div class="flex flex-col mb-3">
                                    <h6 style="float:left;">Signature <span style="color:red">*</span></h6><h4 id="signature_lang"> </h4>
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
                                    <h6 style="float:left;">Referral </h6><h4 id="referral_lang"></h4>
                                    <input type="text" name="referral" class="form-control" placeholder="Please enter the referral's email address, phone number and name" aria-label="Referral" value="{{ old('referral') }}" id="referral">
                                    @error('referral') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
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
