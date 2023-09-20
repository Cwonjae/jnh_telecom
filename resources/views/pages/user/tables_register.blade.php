@extends('layouts.user.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')

    <script>
        $(function () {
            $('.js-signature').jqSignature();
        });

        function clearCanvas() {
            $('.js-signature').jqSignature('clearCanvas');
        }

        /**
         *  국가 입력시 자동완성 기능 추가
         * */
        const dataList = ["Albania","Algeria","Afghanistan","Kabol","America","Angola","Antigua and Barbuda Armenia","Republic of Armenia","Australia","Azerbaijan","Bahrain","Barbados","Belarus","Belgium","Bolivia","Bosnia","Brazil","Bulgaria","Burundi","Cambodia","Cameroon","Canada","Central African Republic","Chad","Chile ",
"China","Colombia","Croatia","Cuba","Cyprus","Czech","Denmark","Egypt","El Salvador","Eritrea","Estonia","Finland","France","Georgia","Germany","Greece","Hong Kong","China","Hungary","India","Indonesia","Iran","Iraq","ireland","Israel","Italy","Japan","Jordan","Kazakhstan","Kenya","Korea","Kuwait","Kyrgyzstan","Latvia","Republic of Latvia","Lebanon","Liberia","Libya","Lithuania","Macedonia","Madagascar","Malaysia","Malta","Mexico","Monaco","Mongolia ","Morocco","Karabakh","Nagorno","Karabakh","Namibia","Netherlands","arab","Nicaragua","Nigeria","Oman","Pakistan","Islamic Republic of Pakistan","Palestine","Panama","Peru","Philippines","Portugal","Qatar","Romania","Russia","Saudi Arabia","Serbia","Singapore","Slovakia","Slovenia","Somalia","South Africa","spain","Sri Lanka","Sudan","Sweden","Switzerland","Syria","Tajikistan","Tanzania","Thailand","See East Timor","Türkiye","Turkmenistan","Turks","Ukraine","United Arab Emirates","United Kingdom","Great Britain and Northern Ireland","United States America","Uzbekistan","Vatican City"];

        const search = document.querySelector("#search");
        const autoComplete = document.querySelector(".autocomplete");
        let nowIndex = 0;

        search.onkeyup = (event) => {
            const value = search.value.trim();
            const matchDataList = value ? dataList.filter((label) => label.includes(value)) : [];

            switch (event.keyCode) {
                case 38:
                    nowIndex = Math.max(nowIndex - 1, 0);
                    break;
                case 40:
                    nowIndex = Math.min(nowIndex + 1, matchDataList.length - 1);
                    break;
                case 13:
                    document.querySelector("#search").value = matchDataList[nowIndex] || "";
                    nowIndex = 0;
                    matchDataList.length = 0;
                    break;
                default:
                    nowIndex = 0;
                    break;
            }

            showList(matchDataList, value, nowIndex);
        };

        const showList = (data, value, nowIndex) => {
            const regex = new RegExp(`(${value})`, "g");
            autoComplete.innerHTML = data.map((label, index) => 
                `
                <div class='${nowIndex === index ? "active" : ""}'>
                    ${label.replace(regex, "<mark>$1</mark>")}
                </div>
                `
            ).join("");
        };
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
                            
                            <form method="POST" action="{{ route('userpage.insert', ['page' => 'tables']) }}">
                            @csrf
                                <div class="flex flex-col mb-3">
                                    <h6>Name</h6>
                                    <input type="text" name="applicant" class="form-control" placeholder="Name" aria-label="Name" value="{{ old('applicant') }}" >
                                    @error('applicant') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <h6>Nationality</h6>
                                    <input type="text" name="nationality" class="form-control" placeholder="Nationality" aria-label="Nationality" value="{{ old('nationality') }}" autocomplete="off" id="search">
                                    <div class="autocomplete"></div>
                                    @error('nationality') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <h6>Passport</h6>
                                    <input type="file" name="passport" class="form-control" aria-label="Passport">
                                    @error('passport') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <h6>Date Of Birth</h6>
                                    <input type="text" name="dateofbirth" class="form-control" placeholder="Date Of Birth" aria-label="Date Of Birth" value="{{ old('dateofbirth') }}" >
                                    @error('dateofbirth') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="form-radio form-check-info text-start">
                                    <h6>Gander</h6><br>
                                    <input class="form-radio-input" type="radio" name="gander" id="flexRadioDefault_m" value="male">
                                    <label class="form-radio-label" for="flexRadioDefault_m">Male</label>
                                    <input class="form-radio-input" type="radio" name="gander" id="flexRadioDefault_f" value="female">
                                    <label class="form-radio-label" for="flexRadioDefault_f">FeMale</label>
                                    @error('gander') <p class='text-danger text-xs'> {{ $message }} </p> @enderror
                                </div>
                                <div class="form-radio form-check-info text-start">
                                    <h6>Device</h6><br>
                                    <input class="form-radio-input" type="radio" name="device" id="flexRadioDefault_ap" value="apple">
                                    <label class="form-radio-label" for="flexRadioDefault_ap">Apple</label>
                                    <input class="form-radio-input" type="radio" name="device" id="flexRadioDefault_s" value="samsung">
                                    <label class="form-radio-label" for="flexRadioDefault_s">Samsung</label>
                                    <input class="form-radio-input" type="radio" name="device" id="flexRadioDefault_o" value="other">
                                    <label class="form-radio-label" for="flexRadioDefault_o">Other</label>
                                    @error('device') <p class='text-danger text-xs'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <h6>Device Model</h6>
                                    <input type="text" name="devicemodel" class="form-control" placeholder="Ex) Iphone 13, Iphone 13 mini, Galaxy S22, ETC" aria-label="Device Model" value="{{ old('devicemodel') }}" >
                                    @error('devicemodel') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <h6>OS Version</h6>
                                    <input type="text" name="osversion" class="form-control" placeholder="Ex) Android Version 13, IOS version 16.5" aria-label="Os Version" value="{{ old('osversion') }}" >
                                    @error('osversion') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <img src="/img/tables/tables4.png" alt="IMEI and S/N" style="max-width: 100%; height: auto;">
                                    <p>Dial *#06# or go to setting - about to find IMEI number.</p>
                                </div>
                                <div class="flex flex-col mb-3">
                                    <h6>IMEI Number</h6>
                                    <input type="text" name="imeinumber" class="form-control" placeholder="IMEI Number" aria-label="IMEI Number" value="{{ old('imeinumber') }}" >
                                    @error('imeinumber') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <p>[Prepaid Plan]</p>
                                    <img src="/img/tables/tables5.png" alt="Prepaid Plan" style="max-width: 100%; height: auto;">
                                    <p>Prepaid Plan: Use charged amount for services.</p>
                                    <p>Validity: Depends on recharge amount, balance expires after.</p>
                                    <p>No refunds or cancellations available.</p>
                                    <p>During validity: Use remaining balance.</p>
                                    <p>After validity: Outgoing calls restricted, then 14 days incoming only, 30 days both suspended, then automatic termination.</p>
                                    <p>Recharge within validity extends period (max 2 years).</p>
                                    <p>Some benefits don't accumulate (e.g., KT mobile-to-mobile calls).</p>
                                    <p>No discounts, points, memberships, rentals, roaming, and specific services.</p>
                                    <p>Switching won't transfer balances or provide refunds.</p>
                                    <p>Postpaid to prepaid: Benefits won't transfer.</p>
                                    <p>Cancelling prepaid after switching: No refund for charged amount.</p>
                                </div>
                                <div class="form-radio form-check-info text-start">
                                    <h6>Plan</h6><br>
                                    <input class="form-radio-input" type="radio" name="plan" id="flexRadioDefault_p" value="ok">
                                    <label class="form-radio-label" for="flexRadioDefault_p">30,000 KRW($23)</label>
                                    <p>Please note that devices purchased from the United States may not be compatible with our 5G plan.</p>
                                    @error('plan') <p class='text-danger text-xs'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <h6>Choose Last Number</h6>
                                    <input type="text" name="chooselastnumber" class="form-control" placeholder="Please choose the last four digits of your phone number." aria-label="Please choose the last four digits of your phone number." value="{{ old('chooselastnumber') }}" >
                                    @error('chooselastnumber') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                    <p>If the phone number you have chosen is already taken, please note that it can be activated with different last four digits.</p>
                                </div>
                                <div class="flex flex-col mb-3">
                                    <h6>Signature</h6>
                                    <div class='js-signature'></div>
                                    <a id="clearBtn" class="btn btn-default" onclick="clearCanvas();">Clear Canvas</a>
                                </div>
                                <div class="flex flex-col mb-3">
                                    <h6>Referral</h6>
                                    <input type="text" name="referral" class="form-control" placeholder="Please enter the referral's email address, phone number and name" aria-label="Referral" value="{{ old('referral') }}" >
                                    @error('referral') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="form-radio form-check-info text-start">
                                    <h6>Add International Calling Service</h6><br>
                                    <input class="form-radio-input" type="radio" name="callservice" id="flexRadioDefault_y" value="yes">
                                    <label class="form-radio-label" for="flexRadioDefault_y">Yes</label>
                                    <input class="form-radio-input" type="radio" name="callservice" id="flexRadioDefault_n" value="no">
                                    <label class="form-radio-label" for="flexRadioDefault_n">No</label>
                                    @error('callservice') <p class='text-danger text-xs'> {{ $message }} </p> @enderror
                                    <p>Extra $5/ month per line</p>
                                </div>
                                <div class="flex flex-col mb-3">
                                    <img src="/img/tables/tables6.png" alt="5G" style="max-width: 100%; height: auto;">
                                    <img src="/img/tables/tables7.png" alt="4G" style="max-width: 100%; height: auto;">
                                </div>
                                <div class="form-radio form-check-info text-start">
                                    <h6>Service</h6><br>
                                    <input class="form-radio-input" type="radio" name="service" id="flexRadioDefault_ag" value="annual_agreement">
                                    <label class="form-radio-label" for="flexRadioDefault_ag">Annual Agreement (25% discount)</label>
                                    <input class="form-radio-input" type="radio" name="service" id="flexRadioDefault_mp" value="monthly_plan">
                                    <label class="form-radio-label" for="flexRadioDefault_mp">Monthly Plan</label>
                                    @error('service') <p class='text-danger text-xs'> {{ $message }} </p> @enderror
                                </div>
                                <div class="form-radio form-check-info text-start">
                                    <h6>Connectivity</h6><br>
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
