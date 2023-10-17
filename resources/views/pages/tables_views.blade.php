@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Olleh Mobile Application Form'])
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
                                <h6 style="float:left;">Name <span style="color:red">*</span></h6><h4 id="name_lang"></h4>
                                <input type="text" name="applicant" class="form-control" placeholder="Your Full Name" aria-label="Name" value="{{ $cell_phones[0]->cpb_applicant }}" id="applicant">
                                @error('applicant') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                            </div>
                            <div class="flex flex-col mb-3">
                                <h6 style="float:left;">Nationality <span style="color:red">*</span></h6><h4 id="nationality_lang"></h4>
                                <input type="text" name="nationality" class="form-control" placeholder="Nationality" aria-label="Nationality" value="{{ $cell_phones[0]->cpb_nationality }}" autocomplete="off" id="inputSearch">
                                @error('nationality') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                            </div>
                            <div class="flex flex-col mb-3">
                                <h6 style="float:left;">Passport Number <span style="color:red">*</span></h6><h4 id="passportnumber_lang"></h4>
                                <input type="text" name="passportnumber" class="form-control" aria-label="PassportNumber" id="passportnumber" value="{{ $cell_phones[0]->cpb_passportnumber }}">
                                @error('passportnumber') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                            </div>
                            <div class="flex flex-col mb-3">
                                <h6 style="float:left;">Passport <span style="color:red">*</span></h6><h4 id="passport_lang"></h4>
                                <input type="file" name="passport" accept="file_extension,image/*" capture="camera" class="form-control" aria-label="Passport" id="passport">
                                @error('passport') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                @if($cell_phones[0]->ppu_filename)
                                @php
                                    $check_extension = explode('.', $cell_phones[0]->ppu_filename);
                                @endphp
                                    <a href="{{ url('storage/images/passport/'.$cell_phones[0]->ppu_encode_filename.'.'.$check_extension[1]) }}" target="_blank">
                                        <span style="font-weight:bold; font-size:14px;">View saved passports</span>
                                    </a>
                                @endif
                            </div>
                            <div class="flex flex-col mb-3">
                                <h6 style="float:left;">Date Of Birth <span style="color:red">*</span></h6><h4 id="deteofbirth_lang"></h4>
                                <input type="text" name="dateofbirth" class="form-control" placeholder="MM-DD-YYYY" aria-label="Date Of Birth" value="{{ $cell_phones[0]->cpb_dateofbirth }}" id="dateofbirth" maxlength="11">
                                @error('dateofbirth') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                            </div>
                            <div class="form-radio form-check-info text-start">
                                <h6 style="float:left;">Gender <span style="color:red">*</span></h6><h4 id="gender_lang"></h4>
                                <input class="form-radio-input" type="radio" name="gender" id="flexRadioDefault_m" value="male" @if($cell_phones[0]->cpb_gender == "male") checked @else @endif>
                                <label class="form-radio-label" for="flexRadioDefault_m">Male</label>
                                <input class="form-radio-input" type="radio" name="gender" id="flexRadioDefault_f" value="female" @if($cell_phones[0]->cpb_gender == "female") checked @else @endif>
                                <label class="form-radio-label" for="flexRadioDefault_f">FeMale</label>
                                @error('gender') <p class='text-danger text-xs'> {{ $message }} </p> @enderror
                            </div>
                            <!-- <div class="form-radio form-check-info text-start">
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
                                <input type="text" name="devicemodel" class="form-control" placeholder="Ex) Iphone 13, Iphone 13 mini, Galaxy S22, etc" aria-label="Device Model" value="{{ $cell_phones[0]->cpb_devicemodel }}" id="devicemodel">
                                @error('devicemodel') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                            </div>
                            <div class="flex flex-col mb-3">
                                <h6>OS Version <span style="color:red">*</span></h6>
                                <input type="text" name="osversion" class="form-control" placeholder="Ex) Android Version 13, IOS version 16.5, etc" aria-label="Os Version" value="{{ $cell_phones[0]->cpb_osversion }}" id="osversion">
                                @error('osversion') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                            </div> -->
                            <div class="flex flex-col mb-3">
                                <img src="/img/tables/tables4.png" alt="IMEI and S/N" style="max-width: 100%; height: auto;">
                                <p>Dial *#06# or go to setting - about to find IMEI number.</p>
                            </div>
                            <div class="flex flex-col mb-3">
                                <h6 style="float:left;">IMEI Number <span style="color:red">*</span></h6><h4 id="imei_lang"></h4>
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
                                <h6 style="float:left;">Plan <span style="color:red">*</span></h6><h4 id="plan_lang"></h4>
                                <input class="form-radio-input" type="radio" name="plan" id="flexRadioDefault_p" value="ok" @if($cell_phones[0]->cpb_plan == "ok") checked @else @endif>
                                <label class="form-radio-label" for="flexRadioDefault_p">30,000 KRW($23)</label>
                                <p>Please note that devices purchased from the United States may not be compatible with our 5G plan.</p>
                                @error('plan') <p class='text-danger text-xs'> {{ $message }} </p> @enderror
                            </div>
                            <div class="flex flex-col mb-3">
                                <h6>Please choose the last four digits of your phone number (Up to 3 items can be entered)</h6><h4 id="choose_lang"></h4>
                                <input type="text" name="chooselastnumber" class="form-control" placeholder="Please choose the last four digits of your phone number." aria-label="Please choose the last four digits of your phone number." value="{{ $cell_phones[0]->cpb_chooselastnumber }}" onKeyPress="javascript:checkInputNum();" onKeyUp="javascript:checkInputValue(this);" maxlength="14" id="chooselastnumber">
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
                                <input type="hidden" id="signature_txt" name="signaturetxt" value="data:image/png;base64,{{ $cell_phones[0]->stu_base64 }}"/>
                                <div id="signature">
                                @if($cell_phones[0]->stu_filename)
                                    <img id="signature_img" src="data:image/png;base64,{{ $cell_phones[0]->stu_base64 }}"/>
                                @endif
                                </div>
                            </div>
                            <div class="flex flex-col mb-3">
                                <h6 style="float:left;">Referral </h6><h4 id="referral_lang"></h4>
                                <input type="text" name="referral" class="form-control" placeholder="Please enter the referral's email address, phone number and name" aria-label="Referral" value="{{ $cell_phones[0]->cpb_referral }}" id="referral">
                                @error('referral') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                            </div>
                            <!-- <div class="form-radio form-check-info text-start">
                                <h6>Add International Calling Service <span style="color:red">*</span></h6>
                                <input class="form-radio-input" type="radio" name="callservice" id="flexRadioDefault_y" value="yes" @if($cell_phones[0]->cpb_callservice == "yes") checked @else @endif>
                                <label class="form-radio-label" for="flexRadioDefault_y">Yes</label>
                                <input class="form-radio-input" type="radio" name="callservice" id="flexRadioDefault_n" value="no" @if($cell_phones[0]->cpb_callservice == "no") checked @else @endif>
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
                                <input class="form-radio-input" type="radio" name="service" id="flexRadioDefault_ag" value="annual_agreement" @if($cell_phones[0]->cpb_service == "annual_agreement") checked @else @endif>
                                <label class="form-radio-label" for="flexRadioDefault_ag">Annual Agreement (25% discount)</label>
                                <input class="form-radio-input" type="radio" name="service" id="flexRadioDefault_mp" value="monthly_plan" @if($cell_phones[0]->cpb_service == "monthly_plan") checked @else @endif>
                                <label class="form-radio-label" for="flexRadioDefault_mp">Monthly Plan</label>
                                @error('service') <p class='text-danger text-xs'> {{ $message }} </p> @enderror
                            </div>
                            <div class="form-radio form-check-info text-start">
                                <h6 style="float:left;">Connectivity <span style="color:red">*</span></h6><h4 id="connectivity_lang"></h4>
                                <input class="form-radio-input" type="radio" name="connectivity" id="flexRadioDefault_4g" value="4g" @if($cell_phones[0]->cpb_connectivity == "4g") checked @else @endif>
                                <label class="form-radio-label" for="flexRadioDefault_4g">4G</label>
                                <input class="form-radio-input" type="radio" name="connectivity" id="flexRadioDefault_5g" value="5g" @if($cell_phones[0]->cpb_connectivity == "5g") checked @else @endif>
                                <label class="form-radio-label" for="flexRadioDefault_5g">5G</label>
                                @error('connectivity') <p class='text-danger text-xs'> {{ $message }} </p> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
