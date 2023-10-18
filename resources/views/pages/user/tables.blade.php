@extends('layouts.user.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.user.topnav', ['title' => 'Olleh Mobile Application Form'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Olleh Mobile Application Form</h6>
                    </div>
                    <div class="pb-0">
                        <div style="float:right; width:120px; height:40px;">
                            <a class="bg-gradient-success" style="padding:10px; font-weight:bold; color:#fff; border-radius:10px 10px 10px 10px; cursor: pointer" 
                            href="{{ route('userpage.register', ['page' => 'tables']) }}">
                                Register
                            </a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Applicant</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Nationality</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Opening Status</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Deferred Payment Status</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Registration date</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            ETC</th>
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
                                            <span class="badge badge-sm
                                            @if ($cell_phone->cpb_status == 'opening') 
                                                bg-gradient-success
                                            @elseif ($cell_phone->cpb_status == 'pending')
                                                bg-gradient-danger
                                            @else
                                                bg-gradient-secondary
                                            @endif
                                            ">{{ $cell_phone->cpb_status }}</span>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            @if ($cell_phone->cpb_after_status == 'apply')
                                                <span class="badge badge-sm bg-gradient-success">Complete</span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-danger"><a>To apply</a></span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ date('Y-m-d H:i:s', strtotime($cell_phone->created_at)) }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="{{ route('userpage.modify', ['page' => 'tables', 'num' => $cell_phone->id]) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                Edit
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td class="align-middle text-center" colspan="6">don't have a history of applying for Olleh Mobile Application Form</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="card-header pb-0">
                                {{ $cell_phones->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.user.footer')
    </div>
@endsection
