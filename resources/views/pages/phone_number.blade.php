@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    <script>
        $(function () {
            $('#phone_number').keyup(function() {
                if(event.keyCode == 8) {
                    $(this).val();
                } else {
                    var val = $(this).val().replace(/[^0-9]/g, '');   
                    
                    if(val.length < 4) {
                        $(this).val(val.substring(0,3) + "-");
                    } else if(val.length >= 4 && val.length < 8) {
                        $(this).val(val.substring(0,3) + "-" + val.substring(3,7) + "-");
                    } else if(val.length > 7) {
                        $(this).val(val.substring(0,3) + "-" + val.substring(3,7) + "-" + val.substring(7,11));
                    } else {
                        $(this).val(val.substring(0,3) + "-" + val.substring(3,7) + "-" + val.substring(7,11));
                    }
                }
            });

            $('#form_submit').click(function() {
                $('#comparison_check').submit();
            });
        });
    </script>
    @include('layouts.navbars.auth.topnav', ['title' => 'Registration Card Comparison'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Phone Number Insert</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0" style="width:92%; margin:auto; margin-top:30px;">
                            <form method="POST" action="{{ route('page.comparisons', ['page' => 'phone_number_insert', 'num' => $cellphone[0]->id]) }}" id="comparison_check" enctype="multipart/form-data">
                                @csrf
                                    <div class="flex flex-col mb-3">
                                        <h6>Phone Number <span style="color:red">*</span></h6>
                                        <input type="text" name="phone_number" class="form-control" aria-label="phone_number" id="phone_number" value="{{ $cellphone[0]->cpb_phonenumber }}">
                                        @error('phone_number') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                    </div>
                            </form>

                            <div class="text-center">
                                <a class="btn bg-gradient-dark w-100 my-4 mb-2" id="form_submit">입력</a>
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
