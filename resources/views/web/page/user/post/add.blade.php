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
            @if (\Auth::check())
            @if (!$user->detail->active)
            <div class="alert alert-warning my-3" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" data-dismiss="alert"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-x close">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg></button>
                <i data-feather="alert-circle"></i>
                Vui lòng kích hoạt tài khoản của bạn qua liên kết chúng tôi đã gửi tới <b>{{ $user->email }}</b>. <a
                    href="javascript:void(0)" class="text-white"><u>Gửi lại liên kết kích hoạt</u></a>
            </div>
            @endif
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
                        <input type="checkbox"
                            {{ session()->has('theme') ? ((session('theme') == 'dark') ?: 'checked') : 'checked' }}
                            class="theme-shifter">
                        <span class="slider round">
                            <i data-feather="sun"></i>
                            <i data-feather="moon"></i>
                        </span>
                    </label>
                </div>
            </div>
            <!-- CONTENT AREA -->
            <div class="container">
                <div class="row layout-spacing layout-top-spacing">
                    <div class="col-md-4 layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4><i data-feather="tool"></i> Công cụ</h4>
                                        <div class="list-group list-group-icons-meta">
                                            <a href="javascript:void(0);"
                                                class="list-group-item list-group-item-action p-0"></a>
                                            <a href="{{ route('admin.post') }}"
                                                class="list-group-item list-group-item-action border-left-0 border-right-0 active">
                                                <div class="media">
                                                    <div class="d-flex mr-3"><i data-feather="list"></i></div>
                                                    <div class="media-body">
                                                        <h6 class="tx-inverse">Quản lý bài viết</h6>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="{{ route('admin.category') }}"
                                                class="list-group-item list-group-item-action border-left-0 border-right-0">
                                                <div class="media">
                                                    <div class="d-flex mr-3"><i data-feather="box"></i></div>
                                                    <div class="media-body">
                                                        <h6 class="tx-inverse">Quản lý chuyên mục</h6>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="javascript:void(0);"
                                                class="list-group-item list-group-item-action p-0"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 layout-spacing">
                        <form method="post" action="" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div id="toolbar-container">
                                    <span class="ql-formats">
                                        {{-- <select class="ql-font"></select> --}}
                                        <select class="ql-size"></select>
                                    </span>
                                    <span class="ql-formats">
                                        <button class="ql-bold"></button>
                                        <button class="ql-italic"></button>
                                        <button class="ql-underline"></button>
                                        <button class="ql-strike"></button>
                                    </span>
                                    <span class="ql-formats">
                                        <select class="ql-color"></select>
                                        <select class="ql-background"></select>
                                    </span>
                                    <span class="ql-formats">
                                        <button class="ql-script" value="sub"></button>
                                        <button class="ql-script" value="super"></button>
                                    </span>
                                    <span class="ql-formats">
                                        <button class="ql-header" value="1"></button>
                                        <button class="ql-header" value="2"></button>
                                        <button class="ql-blockquote"></button>
                                        <button class="ql-code-block"></button>
                                    </span>
                                    <br />
                                    <span class="ql-formats">
                                        <button class="ql-list" value="ordered"></button>
                                        <button class="ql-list" value="bullet"></button>
                                        <button class="ql-indent" value="-1"></button>
                                        <button class="ql-indent" value="+1"></button>
                                    </span>
                                    <span class="ql-formats">
                                        <button class="ql-direction" value="rtl"></button>
                                        <select class="ql-align"></select>
                                    </span>
                                    <span class="ql-formats">
                                        <button class="ql-link"></button>
                                        <button class="ql-image"></button>
                                        <button class="ql-video"></button>
                                        <button class="ql-formula"></button>
                                    </span>
                                    <span class="ql-formats">
                                        <button class="ql-clean"></button>
                                    </span>
                                </div>
                                <div id="post_content"></div>
                            </div>
                        </form>
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
