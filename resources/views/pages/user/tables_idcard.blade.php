@extends('layouts.user.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    <script>
        $(function () {
            $('#form_submit').click(function() {
                formCheck();
            });

            $('#lang_check').change(function() {
                var value = $(this).val();
                switch(value) {
                    case 'english' :
                        $('#idcard_lang').html("Registration Card <span style='color:red'>*</span>");
                        break;
                    case 'russian' :
                        $('#idcard_lang').html("регистрационная карта <span style='color:red'>*</span>");
                        break;
                    case 'uzbek' :
                        $('#idcard_lang').html("ro'yxatga olish kartasi <span style='color:red'>*</span>");
                        break;
                    case 'tagalog' :
                        $('#idcard_lang').html("kard ng pagpaparehistro <span style='color:red'>*</span>");
                        break;
                    case 'vietnamese' :
                        $('#idcard_lang').html("Thẻ đăng ký <span style='color:red'>*</span>");
                        break;
                    default :
                        break;
                }
            });
        });

        function formCheck() {
            $('#idcard_insert').submit();
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
                            
                            <form method="POST" action="{{ route('userpage.idcard-insert', ['page' => 'tables', 'num' => $cpb_num]) }}" id="idcard_insert" enctype="multipart/form-data">
                            @csrf
                                <div class="flex flex-col mb-3">
                                    <h6 id="idcard_lang">Registration Card <span style="color:red">*</span></h6>
                                    <input type="file" name="registrationcard" accept="file_extension,image/*" capture="camera" class="form-control" aria-label="Registration Card" id="registrationcard">
                                    @error('registrationcard') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
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
