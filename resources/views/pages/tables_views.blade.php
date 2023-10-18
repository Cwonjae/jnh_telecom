@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => '가입신청 (선불)'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>가입신청 (선불)</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0" style="width:92%; margin:auto; margin-top:30px;">
                            <div class="flex flex-col mb-3">
                                <h6 style="float:left;">Name <span style="color:red">*</span></h6><h4 id="name_lang"></h4>
                                <input type="text" name="applicant" class="form-control" placeholder="Your Full Name" aria-label="Name" value="{{ $cell_phones[0]->cpb_applicant }}" id="applicant" readonly>
                            </div>
                            <div class="flex flex-col mb-3">
                                <h6 style="float:left;">Nationality <span style="color:red">*</span></h6><h4 id="nationality_lang"></h4>
                                <input type="text" name="nationality" class="form-control" placeholder="Nationality" aria-label="Nationality" value="{{ $cell_phones[0]->cpb_nationality }}" autocomplete="off" id="inputSearch" readonly>
                            </div>
                            <div class="flex flex-col mb-3">
                                <h6 style="float:left;">Passport Number <span style="color:red">*</span></h6><h4 id="passportnumber_lang"></h4>
                                <input type="text" name="passportnumber" class="form-control" aria-label="PassportNumber" id="passportnumber" value="{{ $cell_phones[0]->cpb_passportnumber }}" readonly>
                            </div>
                            <div class="flex flex-col mb-3">
                                <h6 style="float:left;">Date Of Birth <span style="color:red">*</span></h6><h4 id="deteofbirth_lang"></h4>
                                <input type="text" name="dateofbirth" class="form-control" placeholder="MM-DD-YYYY" aria-label="Date Of Birth" value="{{ $cell_phones[0]->cpb_dateofbirth }}" id="dateofbirth" maxlength="11" readonly>
                            </div>
                            <div class="form-radio form-check-info text-start">
                                <h6>Gender <span style="color:red">*</span></h6><h4 id="gender_lang"></h4>
                                <input class="form-radio-input" type="radio" name="gender" id="flexRadioDefault_m" value="male" @if($cell_phones[0]->cpb_gender == "male") checked @else @endif>
                                <label class="form-radio-label" for="flexRadioDefault_m">Male</label>
                                <input class="form-radio-input" type="radio" name="gender" id="flexRadioDefault_f" value="female" @if($cell_phones[0]->cpb_gender == "female") checked @else @endif>
                                <label class="form-radio-label" for="flexRadioDefault_f">FeMale</label>
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
                                <h6 style="float:left;">IMEI Number <span style="color:red">*</span></h6><h4 id="imei_lang"></h4>
                                <input type="text" name="imeinumber" class="form-control" placeholder="IMEI Number" aria-label="IMEI Number" value="{{ $cell_phones[0]->cpb_imeinumber }}" id="imeinumber" readonly>
                            </div>
                            <div class="form-radio form-check-info text-start">
                                <h6>Plan <span style="color:red">*</span></h6><h4 id="plan_lang"></h4>
                                <input class="form-radio-input" type="radio" name="plan" id="flexRadioDefault_p" value="ok" @if($cell_phones[0]->cpb_plan == "ok") checked @else @endif>
                                <label class="form-radio-label" for="flexRadioDefault_p">30,000 KRW($23)</label>
                            </div>
                            <div class="flex flex-col mb-3">
                                <h6>Please choose the last four digits of your phone number (Up to 3 items can be entered)</h6><h4 id="choose_lang"></h4>
                                <input type="text" name="chooselastnumber" class="form-control" placeholder="Please choose the last four digits of your phone number." aria-label="Please choose the last four digits of your phone number." value="{{ $cell_phones[0]->cpb_chooselastnumber }}" onKeyPress="javascript:checkInputNum();" onKeyUp="javascript:checkInputValue(this);" maxlength="14" id="chooselastnumber" readonly>
                            </div>
                            <div class="flex flex-col mb-3">
                                <h6>Signature <span style="color:red">*</span></h6><h4 id="signature_lang"></h4>
                                <div id="signature">
                                @if($cell_phones[0]->stu_filename)
                                    <img id="signature_img" src="data:image/png;base64,{{ $cell_phones[0]->stu_base64 }}"/>
                                @endif
                                </div>
                            </div>
                            <div class="flex flex-col mb-3">
                                <h6 style="float:left;">Referral </h6><h4 id="referral_lang"></h4>
                                <input type="text" name="referral" class="form-control" placeholder="Please enter the referral's email address, phone number and name" aria-label="Referral" value="{{ $cell_phones[0]->cpb_referral }}" id="referral" readonly>
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
                            <div class="form-radio form-check-info text-start">
                                <h6>Service <span style="color:red">*</span></h6><h4 id="service_lang"></h4>
                                <input class="form-radio-input" type="radio" name="service" id="flexRadioDefault_ag" value="annual_agreement" @if($cell_phones[0]->cpb_service == "annual_agreement") checked @else @endif>
                                <label class="form-radio-label" for="flexRadioDefault_ag">Annual Agreement (25% discount)</label>
                                <input class="form-radio-input" type="radio" name="service" id="flexRadioDefault_mp" value="monthly_plan" @if($cell_phones[0]->cpb_service == "monthly_plan") checked @else @endif>
                                <label class="form-radio-label" for="flexRadioDefault_mp">Monthly Plan</label>
                            </div>
                            <div class="form-radio form-check-info text-start">
                                <h6>Connectivity <span style="color:red">*</span></h6><h4 id="connectivity_lang"></h4>
                                <input class="form-radio-input" type="radio" name="connectivity" id="flexRadioDefault_4g" value="4g" @if($cell_phones[0]->cpb_connectivity == "4g") checked @else @endif>
                                <label class="form-radio-label" for="flexRadioDefault_4g">4G</label>
                                <input class="form-radio-input" type="radio" name="connectivity" id="flexRadioDefault_5g" value="5g" @if($cell_phones[0]->cpb_connectivity == "5g") checked @else @endif>
                                <label class="form-radio-label" for="flexRadioDefault_5g">5G</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
