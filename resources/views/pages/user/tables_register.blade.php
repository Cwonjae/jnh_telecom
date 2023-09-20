@extends('layouts.user.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')

    <script>
    // $(document).on('ready', function() {
    //     if ($('.js-signature').length) {
    //         $('.js-signature').jqSignature();
    //     }
    // });

    $(function () {
        $('.js-signature').jqSignature();
    });

    function clearCanvas() {
        $('.js-signature').jqSignature('clearCanvas');
        $('#saveBtn').css('display', 'none');
    }

    // function saveSignature() {
    // 	$('#signature').empty();
    // 	var dataUrl = $('.js-signature').eq(1).jqSignature('getDataURL');
    // 	var img = $('<img>').attr('src', dataUrl);
    // 	$('#signature').append($('<p>').text("Here's your signature:"));
    // 	$('#signature').append(img);
    // }

    // $('.js-signature').eq(1).on('jq.signature.changed', function() {
    // 	$('#saveBtn').attr('disabled', false);
    // });

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
                            
                            <form method="POST" action="{{ route('userpage.insert', ['page' => 'tables']) }}">
                            @csrf
                                <div class="flex flex-col mb-3">
                                    <label>Name</label>
                                    <input type="text" name="applicant" class="form-control" placeholder="Name" aria-label="Name" value="{{ old('applicant') }}" >
                                    @error('applicant') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <label>Nationality</label>
                                    <input type="text" name="nationality" class="form-control" placeholder="Nationality" aria-label="Nationality" value="{{ old('nationality') }}" >
                                    @error('nationality') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <label>Passport</label>
                                    <input type="file" name="passport" class="form-control" aria-label="Passport">
                                    @error('passport') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <label>Date Of Birth</label>
                                    <input type="text" name="dateofbirth" class="form-control" placeholder="Date Of Birth" aria-label="Date Of Birth" value="{{ old('dateofbirth') }}" >
                                    @error('dateofbirth') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="form-radio form-check-info text-start">
                                    <label>Gander</label><br>
                                    <input class="form-radio-input" type="radio" name="gander" id="flexRadioDefault_m" value="male">
                                    <label class="form-radio-label" for="flexRadioDefault_m">Male</label>
                                    <input class="form-radio-input" type="radio" name="gander" id="flexRadioDefault_f" value="female">
                                    <label class="form-radio-label" for="flexRadioDefault_f">FeMale</label>
                                    @error('gander') <p class='text-danger text-xs'> {{ $message }} </p> @enderror
                                </div>
                                <div class="form-radio form-check-info text-start">
                                    <label>Device</label><br>
                                    <input class="form-radio-input" type="radio" name="device" id="flexRadioDefault_ap" value="apple">
                                    <label class="form-radio-label" for="flexRadioDefault_ap">Apple</label>
                                    <input class="form-radio-input" type="radio" name="device" id="flexRadioDefault_s" value="samsung">
                                    <label class="form-radio-label" for="flexRadioDefault_s">Samsung</label>
                                    <input class="form-radio-input" type="radio" name="device" id="flexRadioDefault_o" value="other">
                                    <label class="form-radio-label" for="flexRadioDefault_o">Other</label>
                                    @error('device') <p class='text-danger text-xs'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <label>Device Model</label>
                                    <input type="text" name="devicemodel" class="form-control" placeholder="Ex) Iphone 13, Iphone 13 mini, Galaxy S22, ETC" aria-label="Device Model" value="{{ old('devicemodel') }}" >
                                    @error('devicemodel') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <label>OS Version</label>
                                    <input type="text" name="osversion" class="form-control" placeholder="Ex) Android Version 13, IOS version 16.5" aria-label="Os Version" value="{{ old('osversion') }}" >
                                    @error('osversion') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <label>IMEI Number</label>
                                    <input type="text" name="imeinumber" class="form-control" placeholder="IMEI Number" aria-label="IMEI Number" value="{{ old('imeinumber') }}" >
                                    @error('imeinumber') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="form-radio form-check-info text-start">
                                    <label>Plan</label><br>
                                    <input class="form-radio-input" type="radio" name="plan" id="flexRadioDefault_p" value="ok">
                                    <label class="form-radio-label" for="flexRadioDefault_p">30,000 KRW($23)</label>
                                    <p>Please note that devices purchased from the United States may not be compatible with our 5G plan.</p>
                                    @error('plan') <p class='text-danger text-xs'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <label>Choose Last Number</label>
                                    <input type="text" name="chooselastnumber" class="form-control" placeholder="Please choose the last four digits of your phone number." aria-label="Please choose the last four digits of your phone number." value="{{ old('chooselastnumber') }}" >
                                    @error('chooselastnumber') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                    <p>If the phone number you have chosen is already taken, please note that it can be activated with different last four digits.</p>
                                </div>
                                <div class="flex flex-col mb-3">
                                    <label>Signature</label>
                                    <div class='js-signature'></div>
                                </div>
                                <div class="flex flex-col mb-3">
                                    <label>Referral</label>
                                    <input type="text" name="referral" class="form-control" placeholder="Please enter the referral's email address, phone number and name" aria-label="Referral" value="{{ old('referral') }}" >
                                    @error('referral') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="form-radio form-check-info text-start">
                                    <label>Add International Calling Service</label><br>
                                    <input class="form-radio-input" type="radio" name="callservice" id="flexRadioDefault_y" value="yes">
                                    <label class="form-radio-label" for="flexRadioDefault_y">Yes</label>
                                    <input class="form-radio-input" type="radio" name="callservice" id="flexRadioDefault_n" value="no">
                                    <label class="form-radio-label" for="flexRadioDefault_n">No</label>
                                    @error('callservice') <p class='text-danger text-xs'> {{ $message }} </p> @enderror
                                </div>
                                <div class="form-radio form-check-info text-start">
                                    <label>Service</label><br>
                                    <input class="form-radio-input" type="radio" name="service" id="flexRadioDefault_ag" value="annual_agreement">
                                    <label class="form-radio-label" for="flexRadioDefault_ag">Annual Agreement (25% discount)</label>
                                    <input class="form-radio-input" type="radio" name="service" id="flexRadioDefault_mp" value="monthly_plan">
                                    <label class="form-radio-label" for="flexRadioDefault_mp">Monthly Plan</label>
                                    @error('service') <p class='text-danger text-xs'> {{ $message }} </p> @enderror
                                </div>
                                <div class="form-radio form-check-info text-start">
                                    <label>Connectivity</label><br>
                                    <input class="form-radio-input" type="radio" name="connectivity" id="flexRadioDefault_4g" value="4g">
                                    <label class="form-radio-label" for="flexRadioDefault_4g">4G</label>
                                    <input class="form-radio-input" type="radio" name="connectivity" id="flexRadioDefault_5g" value="5g">
                                    <label class="form-radio-label" for="flexRadioDefault_5g">5G</label>
                                    @error('connectivity') <p class='text-danger text-xs'> {{ $message }} </p> @enderror
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Submit Form</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.user.footer')
    </div>
@endsection
