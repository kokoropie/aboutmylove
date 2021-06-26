@extends('web.main')

@section('body')
<x-layout::header :name-page="$namePage" :active-navbar="$active" />
<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container" id="container">

    <div class="overlay"></div>
    <div class="search-overlay"></div>
    
    <!--  BEGIN CONTENT AREA  -->
    <div class="main-content" id="content">
        <div class="layout-px-spacing">
            @if (!$user->detail->active)
            <div class="alert alert-warning my-3" role="alert">
                <i data-feather="alert-circle"></i>
                Vui lòng kích hoạt tài khoản của bạn qua liên kết chúng tôi đã gửi tới <b>{{ $user->email }}</b>. <a href="javascript:void(0)" class="text-white"><u>Gửi lại liên kết kích hoạt</u></a>
            </div>
            @endif
            
            <div class="page-header">
                <nav class="breadcrumb-one" aria-label="breadcrumb">
                    <div class="title">
                        <h3>{{ $title }}</h3>
                    </div>
                    <ol class="breadcrumb">
                        @foreach ($breadcrumb as $item)
                            @if ($loop->last)
                                <li class="breadcrumb-item active" aria-current="page"><span>{{ $item["title"] }}</span></li>
                            @else
                                <li class="breadcrumb-item"><a href="{{ $item["url"] }}">{{ $item["title"] }}</a></li>
                            @endif
                        @endforeach
                    </ol>
                </nav>
                <div class="toggle-switch">
                    <label class="switch s-icons s-outline  s-outline-secondary">
                        <input type="checkbox" {{ session()->has('theme') ? ((session('theme') == 'dark') ?: 'checked') : 'checked' }} class="theme-shifter">
                        <span class="slider round">
                            <i data-feather="sun"></i>
                            <i data-feather="moon"></i>
                        </span>
                    </label>
                </div>
            </div>

            <div class="row layout-spacing">
                <div class="col-xl-4 col-lg-6 col-md-5 col-sm-12 layout-top-spacing">
                        <div class="user-profile layout-spacing">
                            <div class="widget-content widget-content-area">
                                <div class="d-flex justify-content-between">
                                    <h3>Thông tin</h3>
                                    <a href="user_account_setting.html" class="mt-2 edit-profile" title="Chỉnh sửa"> <i data-feather="edit-3"></i></a>
                                </div>
                                <div class="text-center user-info">
                                    <img src="{{ asset('assets/img/90x90.jpg') }}" alt="avatar">
                                    <p>{{ $user->detail->nickname }}</p>
                                    <em>{{ $user->detail->signature }}</em>
                                </div>
                                <div class="user-info-list">
                                    <div>
                                        <ul class="contacts-block list-unstyled">
                                            <li class="contacts-block__item bs-popover" data-container="body" data-trigger="hover" data-content="{{ "@" . $user->username }}">
                                                <i data-feather="at-sign"></i><a href="javascript:void(0)">{{ $user->username }}</a>
                                            </li>
                                            @if ($user->detail->show_email)
                                                <li class="contacts-block__item bs-popover text-inline" data-container="body" data-trigger="hover" data-content="{{ $user->email }}" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                                    <i data-feather="mail"></i><a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                                </li>
                                            @endif
                                            @if ($user->detail->show_phone)
                                            <li class="contacts-block__item bs-popover" data-container="body" data-trigger="hover" data-content="Số điện thoại: {{ $user->phone }}">
                                                <i data-feather="phone"></i>{{ $user->phone }}
                                            </li>
                                            @endif
                                            <li class="contacts-block__item bs-popover" data-container="body" data-trigger="hover" data-content="Tham gia lúc {{ $user->created_at }}">
                                                <i data-feather="calendar"></i>{{ $user->created_at->isoFormat("YYYY-MM-DD") }}
                                            </li>
                                            @if ($user->detail->facebook || $user->detail->twitter)
                                            <li class="contacts-block__item">
                                                <ul class="list-inline text-center">
                                                    @if ($user->detail->facebook)
                                                        <li class="list-inline-item">
                                                            <a href="https://fb.com/{{ $user->detail->facebook }}" target="_blank">
                                                                <div class="social-icon">
                                                                    <i data-feather="facebook"></i>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    @endif
                                                    @if ($user->detail->twitter)
                                                        <li class="list-inline-item">
                                                            <a href="https://twitter.com/{{ $user->detail->twitter }}" target="_blank">
                                                                <div class="social-icon">
                                                                    <i data-feather="twitter"></i>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </li>
                                            @endif
                                        </ul>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                        <div class="bio layout-spacing ">
                            <div class="widget-content widget-content-area">
                                <h3>Mô tả</h3>
                                <p>{{ empty($user->detail->bio) ? "Đây là mô tả của " . $user->detail->nickname : $user->detail->bio }}</p>
                            </div>                                
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-6 col-md-7 col-sm-12 layout-top-spacing">
                        <div class="skills layout-spacing ">
                            <div class="widget-content widget-content-area">
                                <h3>Skills</h3>
                                <div class="progress br-30">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><div class="progress-title"><span>PHP</span> <span>25%</span> </div></div>
                                </div>
                                <div class="progress br-30">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 50%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><div class="progress-title"><span>Wordpress</span> <span>50%</span> </div></div>
                                </div>
                                <div class="progress br-30">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 70%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><div class="progress-title"><span>Javascript</span> <span>70%</span> </div></div>
                                </div>
                                <div class="progress br-30">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 60%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><div class="progress-title"><span>jQuery</span> <span>60%</span> </div></div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <!-- CONTENT AREA -->
    </div>
    <!--  END CONTENT AREA  -->
    <x-layout::footer :name-page="$namePage" />
</div>
<!--  END MAIN CONTAINER  -->
@endsection