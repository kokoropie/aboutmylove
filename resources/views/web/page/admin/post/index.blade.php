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
                <i data-feather="alert-circle"></i>
                Vui lòng kích hoạt tài khoản của bạn qua liên kết chúng tôi đã gửi tới <b>{{ $user->email }}</b>. <a href="javascript:void(0)" class="text-white"><u>Gửi lại liên kết kích hoạt</u></a>
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
                        <input type="checkbox" {{ session()->has('theme') ? ((session('theme') == 'dark') ?: 'checked') : 'checked' }} class="theme-shifter">
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
                                        <x-admin::tool active="post" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 layout-spacing" id="list_post_parent">
                        <table id="list_post" class="table table-striped table-hover nowrap">
                            <thead>
                                <tr>
                                    <th class="checkbox-column">ID</th>
                                    <th>Ảnh bìa</th>
                                    <th>Tiêu đề</th>
                                    <th>Liên Kết</th>
                                    <th>Nội dung</th>
                                    <th>Lượt xem</th>
                                    <th>Lượt thích</th>
                                    <th>Số bình luận</th>
                                    <th>Tác giả</th>
                                    <th>Tạo</th>
                                    <th>Cập nhật</th>
                                    <th>
                                        <a href="{{ route('admin.post.add') }}" title="Thêm"><i data-feather="plus-circle" class="text-success"></i></a><a href="javascript:void(0)" onclick="confirmDeleteMultiPosts()" title="Xóa"><i data-feather="x-circle" class="text-danger"></i></a>
                                    </th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="checkbox-column">ID</th>
                                    <th>Ảnh bìa</th>
                                    <th>Tiêu đề</th>
                                    <th>Liên Kết</th>
                                    <th>Nội dung</th>
                                    <th>Lượt xem</th>
                                    <th>Lượt thích</th>
                                    <th>Số bình luận</th>
                                    <th>Tác giả</th>
                                    <th>Tạo</th>
                                    <th>Cập nhật</th>
                                    <th>
                                        <a href="{{ route('admin.post.add') }}" title="Thêm"><i data-feather="plus-circle" class="text-success"></i></a><a href="javascript:void(0)" onclick="confirmDeleteMultiPosts()" title="Xóa"><i data-feather="x-circle" class="text-danger"></i></a>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
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