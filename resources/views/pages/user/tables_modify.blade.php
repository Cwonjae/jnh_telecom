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
    </script>

    @include('layouts.navbars.auth.user.topnav', ['title' => 'Cell Phone Opening Register'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Cell Phone Opening Register</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0" style="width:92%; margin:auto; margin-top:30px;">

                            <div class="flex flex-col mb-3">
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
                            </div>
                            
                            <form method="POST" action="" id="cellPhone_register" enctype="multipart/form-data">
                            @csrf
                                <div class="flex flex-col mb-3">
                                    <h6>Name <span style="color:red">*</span></h6>
                                    <input type="text" name="applicant" class="form-control" placeholder="Your Full Name" aria-label="Name" value="{{ $cell_phones[0]->cpb_applicant }}" id="applicant">
                                    @error('applicant') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <h6>Nationality <span style="color:red">*</span></h6>
                                    <input type="text" name="nationality" class="form-control" placeholder="Nationality" aria-label="Nationality" value="{{ $cell_phones[0]->cpb_nationality }}" autocomplete="off" id="inputSearch">
                                    @error('nationality') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <h6>Passport <span style="color:red">*</span></h6>
                                    <input type="file" name="passport" class="form-control" aria-label="Passport" id="passport">
                                    @error('passport') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                    @if($cell_phones[0]->ppu_filename)
                                    @php
                                        $check_extension = explode('.', $cell_phones[0]->ppu_filename);
                                    @endphp
                                        <a href="{{ url('storage/passport/'.$cell_phones[0]->ppu_encode_filename.'.'.$check_extension[1]) }}" target="_blank">
                                            View saved passports
                                        </a>
                                    @endif
                                </div>
                                <div class="flex flex-col mb-3">
                                    <h6>Date Of Birth <span style="color:red">*</span></h6>
                                    <input type="text" name="dateofbirth" class="form-control" placeholder="MM-DD-YYYY" aria-label="Date Of Birth" value="{{ $cell_phones[0]->cpb_dateofbirth }}" id="dateofbirth" maxlength="11">
                                    @error('dateofbirth') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="form-radio form-check-info text-start">
                                    <h6>Gender <span style="color:red">*</span></h6>
                                    <input class="form-radio-input" type="radio" name="gender" id="flexRadioDefault_m" value="male" @if($cell_phones[0]->cpb_gender == "male") checked @else @endif>
                                    <label class="form-radio-label" for="flexRadioDefault_m">Male</label>
                                    <input class="form-radio-input" type="radio" name="gender" id="flexRadioDefault_f" value="female" @if($cell_phones[0]->cpb_gender == "female") checked @else @endif>
                                    <label class="form-radio-label" for="flexRadioDefault_f">FeMale</label>
                                    @error('gender') <p class='text-danger text-xs'> {{ $message }} </p> @enderror
                                </div>
                                <div class="form-radio form-check-info text-start">
                                    <h6>Device <span style="color:red">*</span></h6>
                                    <input class="form-radio-input" type="radio" name="device" id="flexRadioDefault_ap" value="apple" @if($cell_phones[0]->cpb_device == "apple") checked @else @endif>
                                    <label class="form-radio-label" for="flexRadioDefault_ap">Apple</label>
                                    <input class="form-radio-input" type="radio" name="device" id="flexRadioDefault_s" value="samsung" @if($cell_phones[0]->cpb_device == "samsung") checked @else @endif>
                                    <label class="form-radio-label" for="flexRadioDefault_s">Samsung</label>
                                    <input class="form-radio-input" type="radio" name="device" id="flexRadioDefault_o" value="other" @if($cell_phones[0]->cpb_device == "other") checked @else @endif>
                                    <label class="form-radio-label" for="flexRadioDefault_o">Other</label>
                                    @error('device') <p class='text-danger text-xs'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <h6>Device Model <span style="color:red">*</span></h6>
                                    <input type="text" name="devicemodel" class="form-control" placeholder="Ex) Iphone 13, Iphone 13 mini, Galaxy S22, ETC" aria-label="Device Model" value="{{ $cell_phones[0]->cpb_devicemodel }}" id="devicemodel">
                                    @error('devicemodel') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <h6>OS Version <span style="color:red">*</span></h6>
                                    <input type="text" name="osversion" class="form-control" placeholder="Ex) Android Version 13, IOS version 16.5" aria-label="Os Version" value="{{ $cell_phones[0]->cpb_osversion }}" id="osversion">
                                    @error('osversion') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <img src="/img/tables/tables4.png" alt="IMEI and S/N" style="max-width: 100%; height: auto;">
                                    <p>Dial *#06# or go to setting - about to find IMEI number.</p>
                                </div>
                                <div class="flex flex-col mb-3">
                                    <h6>IMEI Number <span style="color:red">*</span></h6>
                                    <input type="text" name="imeinumber" class="form-control" placeholder="IMEI Number" aria-label="IMEI Number" value="{{ $cell_phones[0]->cpb_imeinumber }}" id="imeinumber">
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
                                    <h6>Plan <span style="color:red">*</span></h6>
                                    <input class="form-radio-input" type="radio" name="plan" id="flexRadioDefault_p" value="ok" @if($cell_phones[0]->cpb_plan == "ok") checked @else @endif>
                                    <label class="form-radio-label" for="flexRadioDefault_p">30,000 KRW($23)</label>
                                    <p>Please note that devices purchased from the United States may not be compatible with our 5G plan.</p>
                                    @error('plan') <p class='text-danger text-xs'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <h6>Please choose the last four digits of your phone number</h6>
                                    <input type="text" name="chooselastnumber" class="form-control" placeholder="Please choose the last four digits of your phone number." aria-label="Please choose the last four digits of your phone number." value="{{ $cell_phones[0]->cpb_chooselastnumber }}" onKeyPress="javascript:checkInputNum();" maxlength="4" id="chooselastnumber">
                                    @error('chooselastnumber') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                    <p>If the phone number you have chosen is already taken, please note that it can be activated with different last four digits.</p>
                                </div>
                                <div class="flex flex-col mb-3">
                                    <h6>Signature <span style="color:red">*</span></h6>
                                    <div class='js-signature'></div>
                                    <a id="clearBtn" class="btn btn-default" onclick="clearCanvas();">Clear Canvas</a>
                                    <a id="saveBtn" class="btn btn-default" onclick="saveSignature();" style="display:none;">Save Signature</a>
                                    <p>Use your mouse or finger to draw your signature above</p>
                                    @error('signaturetxt') <p class='text-danger text-xs'> {{ $message }} </p> @enderror
                                    <input type="hidden" id="signature_txt" name="signaturetxt" value="data:image/png;base64,{{ $cell_phones[0]->stu_base64 }}"/>
                                    <div id="signature">
                                    @if($cell_phones[0]->stu_filename)
                                        <img id="signature_img" src="data:image/png;base64,{{ $cell_phones[0]->stu_base64 }}"/>
                                    @endif
                                    </div>
                                </div>
                                <div class="flex flex-col mb-3">
                                    <h6>Referral</h6>
                                    <input type="text" name="referral" class="form-control" placeholder="Please enter the referral's email address, phone number and name" aria-label="Referral" value="{{ $cell_phones[0]->cpb_referral }}" id="referral">
                                    @error('referral') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="form-radio form-check-info text-start">
                                    <h6>Add International Calling Service <span style="color:red">*</span></h6>
                                    <input class="form-radio-input" type="radio" name="callservice" id="flexRadioDefault_y" value="yes" @if($cell_phones[0]->cpb_callservice == "yes") checked @else @endif>
                                    <label class="form-radio-label" for="flexRadioDefault_y">Yes</label>
                                    <input class="form-radio-input" type="radio" name="callservice" id="flexRadioDefault_n" value="no" @if($cell_phones[0]->cpb_callservice == "no") checked @else @endif>
                                    <label class="form-radio-label" for="flexRadioDefault_n">No</label>
                                    @error('callservice') <p class='text-danger text-xs'> {{ $message }} </p> @enderror
                                    <p>Extra $5/ month per line</p>
                                </div>
                                <div class="flex flex-col mb-3">
                                    <img src="/img/tables/tables6.png" alt="5G" style="max-width: 100%; height: auto;">
                                    <img src="/img/tables/tables7.png" alt="4G" style="max-width: 100%; height: auto;">
                                </div>
                                <div class="form-radio form-check-info text-start">
                                    <h6>Service <span style="color:red">*</span></h6>
                                    <input class="form-radio-input" type="radio" name="service" id="flexRadioDefault_ag" value="annual_agreement" @if($cell_phones[0]->cpb_service == "annual_agreement") checked @else @endif>
                                    <label class="form-radio-label" for="flexRadioDefault_ag">Annual Agreement (25% discount)</label>
                                    <input class="form-radio-input" type="radio" name="service" id="flexRadioDefault_mp" value="monthly_plan" @if($cell_phones[0]->cpb_service == "monthly_plan") checked @else @endif>
                                    <label class="form-radio-label" for="flexRadioDefault_mp">Monthly Plan</label>
                                    @error('service') <p class='text-danger text-xs'> {{ $message }} </p> @enderror
                                </div>
                                <div class="form-radio form-check-info text-start">
                                    <h6>Connectivity <span style="color:red">*</span></h6>
                                    <input class="form-radio-input" type="radio" name="connectivity" id="flexRadioDefault_4g" value="4g" @if($cell_phones[0]->cpb_connectivity == "4g") checked @else @endif>
                                    <label class="form-radio-label" for="flexRadioDefault_4g">4G</label>
                                    <input class="form-radio-input" type="radio" name="connectivity" id="flexRadioDefault_5g" value="5g" @if($cell_phones[0]->cpb_connectivity == "5g") checked @else @endif>
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
