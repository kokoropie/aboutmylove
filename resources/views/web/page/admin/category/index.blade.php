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
                                        <x-admin::tool active="category" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 layout-spacing" id="list_category_parent">
                        <table id="list_category" class="table table-striped table-hover nowrap">
                            <thead>
                                <tr>
                                    <th class="checkbox-column">ID</th>
                                    <th>Tiêu đề</th>
                                    <th>Liên Kết</th>
                                    <th>Số bài viết</th>
                                    <th>Tạo</th>
                                    <th>Cập nhật</th>
                                    <th>
                                        <a href="javascript:void(0)" title="Thêm" onclick="$('#addCategoryModal').modal('show')"><i data-feather="plus-circle" class="text-success"></i></a><a href="javascript:void(0)" onclick="confirmDeleteMultiCategories()" title="Xóa"><i data-feather="x-circle" class="text-danger"></i></a>
                                    </th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Tiêu đề</th>
                                    <th>Liên Kết</th>
                                    <th>Số bài viết</th>
                                    <th>Tạo</th>
                                    <th>Cập nhật</th>
                                    <th>
                                        <a href="javascript:void(0)" title="Thêm" onclick="$('#addCategoryModal').modal('show')"><i data-feather="plus-circle" class="text-success"></i></a><a href="javascript:void(0)" onclick="confirmDeleteMultiCategories()" title="Xóa"><i data-feather="x-circle" class="text-danger"></i></a>
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
@section('modal')
<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryLabel">Thêm chuyên mục</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Đóng">
                  <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="addCategoryForm">
                    <div class="input-group mb-4" id="title-field">
                        <div class="input-group-prepend">
                            <span class="input-group-text bs-tooltip" title="Tiêu đề"><i data-feather="info"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Tiêu đề" aria-label="title" id="title" />
                        <small class="col-12 text-danger"></small>
                    </div>
                    <div class="input-group mb-1" id="slug-field">
                        <div class="input-group-prepend">
                            <span class="input-group-text bs-tooltip" title="Liên kết"><i data-feather="link"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="tieu-de" aria-label="slug" id="slug" />
                        <small class="col-12 text-danger"></small>
                    </div>
                    <p id="preview_link">{{ route('category', 'tieu-de') }}</p>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-warning" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Hủy</button>
                <button type="submit" class="btn btn-info" form="addCategoryForm">Thêm</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryLabel">Sửa chuyên mục</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Đóng">
                  <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="editCategoryForm">
                    <input type="hidden" name="category_id" id="id" />
                    <div class="input-group mb-4" id="title-field">
                        <div class="input-group-prepend">
                            <span class="input-group-text bs-tooltip" title="Tiêu đề"><i data-feather="info"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Tiêu đề" aria-label="title" id="title" />
                        <small class="col-12 text-danger"></small>
                    </div>
                    <div class="input-group mb-1" id="slug-field">
                        <div class="input-group-prepend">
                            <span class="input-group-text bs-tooltip" title="Liên kết"><i data-feather="link"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="tieu-de" aria-label="slug" id="slug" />
                        <small class="col-12 text-danger"></small>
                    </div>
                    <p id="preview_link">{{ route('category', 'tieu-de') }}</p>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-warning" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Hủy</button>
                <button type="submit" class="btn btn-info" form="editCategoryForm">Cập nhật</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteCategoryModal" tabindex="-1" role="dialog" aria-labelledby="deleteCategoryLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCategoryLabel">Xóa chuyên mục</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Đóng">
                  <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <p class="modal-text" id="deleteCatgoryContent"></p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Hủy</button>
                <button type="button" class="btn btn-danger">Xóa</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteMultiCategoriesModal" tabindex="-1" role="dialog" aria-labelledby="deleteMultiCategoriesLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteMultiCategoriesLabel">Xóa chuyên mục</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Đóng">
                  <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <p class="modal-text" id="deleteMultiCategoriesContent"></p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Hủy</button>
                <button type="button" class="btn btn-danger" onclick="deleteMultiCategories()">Xóa</button>
            </div>
        </div>
    </div>
</div>
@endsection