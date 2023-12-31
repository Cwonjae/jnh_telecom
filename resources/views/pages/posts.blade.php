@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
<script>
    function confirm_status(value) {
        $('#dialog-message').dialog({
            modal: true, 
            buttons: {
                "최종완료": function() { 
                    $(this).dialog('close');
                    location.href = "/admin/posts/change/"+value+"/apply";
                },
                "보류": function() { 
                    $(this).dialog('close');
                    location.href = "/admin/posts/change/"+value+"/pending";
                },
                "취소": function() { 
                    $(this).dialog('close'); 
                }
            }
        });
    }
</script>
    @include('layouts.navbars.auth.topnav', ['title' => '가입신청 (후불)'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>가입신청 (후불)</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            신청자명 / 이메일</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            선불 가입신청 상태</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            후불 가입신청 상태</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            가입신청일</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            핸드폰번호</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            외국인등록증 확인</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            메일 전송(외국인등록증 등록 메일)</th>
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
                                                    class="badge badge-sm bg-gradient-secondary"
                                                @elseif ($cell_phone->cpb_after_status == 'processing')
                                                    class="badge badge-sm bg-gradient-danger" onclick="confirm_status({{ $cell_phone->id }})" style="cursor:pointer"
                                                @elseif ($cell_phone->cpb_after_status == 'pending')
                                                    class="badge badge-sm bg-gradient-danger" onclick="confirm_status({{ $cell_phone->id }})" style="cursor:pointer"
                                                @else
                                                    class="badge badge-sm bg-gradient-success"
                                                @endif
                                                >{{ $cell_phone->cpb_after_status }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ date('Y-m-d H:i:s', strtotime($cell_phone->created_at)) }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            @if (!$cell_phone->cpb_phonenumber)
                                                <a style="color: red;" href="{{ route('page.print', ['page' => 'phone_number', 'num' => $cell_phone->id]) }}">입력</a>
                                            @else
                                                @if (!$cell_phone->cpb_usimnumber)
                                                    <a style="color: red;" href="{{ route('page.print', ['page' => 'phone_number', 'num' => $cell_phone->id]) }}">{{ $cell_phone->cpb_phonenumber }}</a>
                                                @else
                                                    <span style="color: green;">{{ $cell_phone->cpb_phonenumber }}</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">
                                            @if (!$cell_phone->cpb_phonenumber)
                                                <a href="#" onclick="javascript:alert('휴대폰 번호 입력 후 외국인등록증 확인이 가능합니다.');">보기</a>
                                            @else
                                                @if($cell_phone->icc_status == "N")
                                                    <a href="{{ route('page.print', ['page' => 'registration_card', 'num' => $cell_phone->icc_id]) }}" style="color: red;">확인 전</a>
                                                @elseif($cell_phone->icc_status == NULL)
                                                    <a style="color: red;">IMG 등록 X</a>
                                                @else
                                                    <a style="color: green;">확인 후</a>
                                                @endif
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">
                                            @if (!$cell_phone->cpb_phonenumber)
                                                <a href="#" onclick="javascript:alert('휴대폰 번호 입력 후 메일 발송이 가능합니다.');">메일 발송</a>
                                            @else
                                                @if($cell_phone->icc_status == NULL)
                                                    @if ($cell_phone->cpb_after_status == 'apply' || $cell_phone->cpb_after_status == 'applying')
                                                        <span>메일 발송 완료</span>
                                                    @else
                                                        <a href="{{ route('page.mailsend', ['page' => 'tables', 'num' => $cell_phone->id]) }}">메일 발송</a>
                                                    @endif
                                                @else
                                                    <span>메일 발송 완료</span>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td class="align-middle text-center" colspan="7">선불제 가입신청이 완료된 내역 또는 후불제 가입신청한 내역이 없습니다.</td>
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
