<div class="list-group list-group-icons-meta">
    <a href="javascript:void(0);" class="list-group-item list-group-item-action p-0 border-0"></a>
    <a href="{{ route('admin.post') }}" class="list-group-item list-group-item-action border-left-0 border-right-0 border-top-0 {{ $active == "post" ? "active" : "" }}">
        <div class="media">
            <div class="d-flex mr-3"><i data-feather="list"></i></div>
            <div class="media-body">
                <h6 class="tx-inverse">Quản lý bài viết</h6>
            </div>
        </div>
    </a>
    <a href="{{ route('admin.category') }}" class="list-group-item list-group-item-action border-left-0 border-right-0 border-bottom-0 {{ $active == "category" ? "active" : "" }}">
        <div class="media">
            <div class="d-flex mr-3"><i data-feather="box"></i></div>
            <div class="media-body">
                <h6 class="tx-inverse">Quản lý chuyên mục</h6>
            </div>
        </div>
    </a>
    <a href="javascript:void(0);" class="list-group-item list-group-item-action p-0 border-0"></a>
</div>