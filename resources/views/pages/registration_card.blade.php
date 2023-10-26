@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    <script>
        $(function () {
            $('#form_submit').click(function() {
                $('#comparison_check').submit();
            });
        });
    </script>
    @include('layouts.navbars.auth.topnav', ['title' => 'Alien registration card Comparison'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Alien registration card Comparison & Phone Number</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0" style="width:92%; margin:auto; margin-top:30px;">
                            <form method="POST" action="{{ route('page.comparisons', ['page' => 'registration_card', 'num' => $idcard[0]->id]) }}" id="comparison_check" enctype="multipart/form-data">
                                @csrf
                                    <div class="flex flex-col mb-3">
                                        <h6>Phone Number <span style="color:red">*</span></h6>
                                        <input type="text" name="phone_number" class="form-control" aria-label="phone_number" id="phone_number" value="{{ $idcard[0]->cpb_phonenumber }}">
                                        @error('phone_number') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                    </div>
                                    <div class="flex flex-col mb-3">
                                        <h6>USIM Number <span style="color:red">*</span></h6>
                                        <input type="text" name="usim_number" class="form-control" aria-label="usim_number" id="usim_number" value="{{ $idcard[0]->cpb_usimnumber }}">
                                        @error('usim_number') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                    </div>
                                    <div class="flex flex-col mb-3">
                                        <h6>Saved Alien registration card Images<span style="color:red">*</span></h6>
                                        @if($idcard[0]->icu_filename)
                                        @php
                                            $check_extension = explode('.', $idcard[0]->icu_filename);
                                        @endphp
                                            <img src="{{ url('storage/images/registrationcard/'.$idcard[0]->icu_encode_filename.'.'.$check_extension[1]) }}" width="100%">
                                        @endif
                                    </div>
                            </form>

                            <div class="text-center">
                                <a class="btn bg-gradient-dark w-100 my-4 mb-2" id="form_submit">확인 및 수정</a>
                            </div>
                            <div id="alert">
                                @include('components.alert')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
