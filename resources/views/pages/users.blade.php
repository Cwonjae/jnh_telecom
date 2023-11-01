@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
<script>
    function excel_down() {
        location.href = "/admin/users/download";
        return false;
    }

    function search_go() {
        $('#search_form').submit();
    }
</script>
    @include('layouts.navbars.auth.topnav', ['title' => '신청자 리스트'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>신청자 리스트</h6>
                    </div>
                    <div class="pb-0">
                        <div style="float:right; width:160px; height:40px; margin-top:7px">
                            <a class="bg-gradient-success" style="padding:10px; font-weight:bold; color:#fff; border-radius:10px 10px 10px 10px; cursor: pointer" 
                            href="#" onclick="excel_down();">
                                Download
                            </a>
                        </div>
                        <div style="float:right; width:400px; height:40px;">
                            <div>
                                <form method="GET" name="search_form" id="search_form">
                                    <select class="search_tag" id="search_tag" name="search_tag" style="height:40px;">
                                        <option value="username" selected>신청자</option>
                                        <option value="email">이메일</option>
                                        <option value="phonenumber">핸드폰번호</option>
                                        <option value="usimnumber">유심번호</option>
                                    </select>
                                    <input type="text" id="search_text" name="search_text" style="height:40px;"/>
                                </form>
                                <a href="javascript:void(0);" onclick="search_go();" class="bg-gradient-warning" style="padding: 8px; font-weight: bold; color: #fff; border-radius: 10px 10px 10px 10px; cursor: pointer; float: right; position: relative; margin-top: -40px; margin-right: 18px; width: 60px; height: 40px; text-align: center;">검색</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            신청자명 / 이메일</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            국적</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            핸드폰번호</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            유심번호</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            선불 가입신청 상태</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            후불 가입신청 상태</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            가입신청일</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($cell_phones as $cell_phone)
                                    <tr>
                                        <td class="align-middle text-center">
                                            <div class="px-2 py-1">
                                                <div class="flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm text-center">{{ $cell_phone->cpb_applicant }}</h6>
                                                    <p class="text-xs text-secondary text-center mb-0">{{ $cell_phone->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-sm text-center">{{ $cell_phone->cpb_nationality }}</span>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-sm text-center">{{ $cell_phone->cpb_phonenumber }}</span>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-sm text-center">{{ $cell_phone->cpb_usimnumber }}</span>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span 
                                                @if ($cell_phone->cpb_status == 'opening') 
                                                    class="badge badge-sm bg-gradient-success"
                                                @elseif ($cell_phone->cpb_status == 'pending')
                                                    class="badge badge-sm bg-gradient-danger"
                                                @else
                                                    class="badge badge-sm bg-gradient-secondary"
                                                @endif
                                                >{{ $cell_phone->cpb_status }}</span>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span 
                                                @if ($cell_phone->cpb_after_status == 'apply') 
                                                    class="badge badge-sm bg-gradient-success"
                                                @elseif ($cell_phone->cpb_after_status == 'applying' || $cell_phone->cpb_after_status == 'processing')
                                                    class="badge badge-sm bg-gradient-danger"
                                                @else
                                                    class="badge badge-sm bg-gradient-secondary"
                                                @endif
                                                >{{ $cell_phone->cpb_after_status }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ date('Y-m-d H:i:s', strtotime($cell_phone->created_at)) }}</span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td class="align-middle text-center" colspan="7">선불제 또는 후불제 가입 신청한 신청자가 없습니다.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="card-header pb-0">
                                {{ $cell_phones->links() }}
                            </div>
                        </div>
                        <div id="alert">
                            @include('components.alert')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
    <div id="dialog-message" title="후불제 가입신청 상태를 변경하시겠습니까?" style='display:none'>
        최종완료 처리 하시겠습니까?<br/>
    </div>
@endsection
