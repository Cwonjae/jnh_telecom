@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
<script>
    function confirm_status(value) {
        $('#dialog-message').dialog({
            modal: true, 
            buttons: {
                "최종완료": function() { 
                    $(this).dialog('close');
                    location.href = "/admin/tables/change/"+value+"/closing";
                },
                "보류": function() { 
                    $(this).dialog('close');
                    location.href = "/admin/tables/change/"+value+"/pending";
                },
                "취소": function() { 
                    $(this).dialog('close'); 
                }
            }
        });
    }
</script>
    @include('layouts.navbars.auth.topnav', ['title' => '가입신청 (선불)'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>가입신청 (선불)</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            신청자명 / 이메일</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            신청자 국적</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            가입신청 상태</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            신청일</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            검증</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            프린트</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            상세보기</th>
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
                                        <td>
                                            <p class="text-xs font-weight-bold text-center mb-0">{{ $cell_phone->cpb_nationality }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            @if($cell_phone->ppc_status == "N")
                                                <span 
                                                    @if ($cell_phone->cpb_status == 'opening') 
                                                        class="badge badge-sm bg-gradient-success" onclick="alert('PassPort 검증과 프린트 완료 후 상태변경할 수 있습니다.')" style="cursor:pointer"
                                                    @elseif ($cell_phone->cpb_status == 'pending')
                                                        class="badge badge-sm bg-gradient-danger" onclick="alert('PassPort 검증과 프린트 완료 후 상태변경할 수 있습니다.')" style="cursor:pointer"
                                                    @else
                                                        class="badge badge-sm bg-gradient-secondary"
                                                    @endif
                                                    >{{ $cell_phone->cpb_status }}</span>
                                            @else
                                                <span 
                                                @if ($cell_phone->cpb_status == 'opening') 
                                                    class="badge badge-sm bg-gradient-success" onclick="confirm_status({{ $cell_phone->id }})" style="cursor:pointer"
                                                @elseif ($cell_phone->cpb_status == 'pending')
                                                    class="badge badge-sm bg-gradient-danger" onclick="confirm_status({{ $cell_phone->id }})" style="cursor:pointer"
                                                @else
                                                    class="badge badge-sm bg-gradient-secondary"
                                                @endif
                                                >{{ $cell_phone->cpb_status }}</span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ date('Y-m-d H:i:s', strtotime($cell_phone->created_at)) }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                @if($cell_phone->ppc_status == "N")
                                                    <a style="color: red;" href="{{ route('page.print', ['page' => 'comparison', 'num' => $cell_phone->ppc_id]) }}">PassPort</a>
                                                @else
                                                    <a style="color: green;">PassPort</a>
                                                @endif
                                                
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            @if($cell_phone->ppc_status == 'N')
                                            <a href="#" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="print page">
                                                <span onclick="alert('Passport 검증 완료 후 Print 가능합니다.');">Print</span>
                                            </a>
                                            @else
                                            <a href="javascript:void(window.open('{{ route('page.print', ['page' => 'print', 'num' => $cell_phone->id]) }}','_blank','fullscreen=yes'))" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="print page">
                                                Print
                                            </a>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="{{ route('page.views', ['page' => 'tables', 'num' => $cell_phone->id]) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="print page">
                                                <span>Views</span>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td class="align-middle text-center" colspan="7">선불제 가입신청한 내역이 없습니다.</td>
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
    <div id="dialog-message" title="선불제 가입신청 상태를 변경하시겠습니까?" style='display:none'>
        최종완료 처리 하시겠습니까?<br/>
    </div>
@endsection
