@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'PassPort Comparison'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>PassPort Comparison</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0" style="width:92%; margin:auto; margin-top:30px;">
                            <form method="POST" action="{{ route('page.comparisons', ['page' => 'comparisons', 'num' => $comparisons[0]->id]) }}" id="cellPhone_register" enctype="multipart/form-data">
                                @csrf
                                    <div class="flex flex-col mb-3">
                                        <h6>Passport Number <span style="color:red">*</span></h6>
                                        <input type="text" name="passportnumber" class="form-control" aria-label="PassportNumber" id="passportnumber" value="{{ $comparisons[0]->cpb_passportnumber }}">
                                        @error('passportnumber') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                    </div>
                                    <div class="flex flex-col mb-3">
                                        <h6>Saved Passport Images<span style="color:red">*</span></h6>
                                        @if($comparisons[0]->ppu_filename)
                                        @php
                                            $check_extension = explode('.', $comparisons[0]->ppu_filename);
                                        @endphp
                                            <img src="{{ url('storage/images/passport/'.$comparisons[0]->ppu_encode_filename.'.'.$check_extension[1]) }}" target="_blank">
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
