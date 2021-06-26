<!-- global -->
<script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('assets/js/elements/popovers.js') }}"></script>
<script src="{{ asset('plugins/notification/snackbar/snackbar.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<!-- {{ $namePage }} -->
@switch($namePage)
    @case('user.login')
    @case('user.register')
        <script>
            feather.replace();
            $(document).ready(function() {
                var togglePassword = document.getElementById("toggle-password");

                if (togglePassword) {
                    togglePassword.addEventListener('change', function() {
                        document.querySelectorAll("[id^=password]").forEach(function(el) {
                            if (el.type === "password") {
                                el.type = "text";
                            } else {
                                el.type = "password";
                            }
                        });
                    });
                }

                $("[data-form]").submit(function(e) {
                    e.preventDefault();
                    let action = $(this).data('form');
                    let method = $(this).attr('method');
                    let route_return = $(this).data("return");
                    let data = $(this).serialize();
                    let submit = $(this).find('[type=submit]');
                    let currentText = submit.text();
                    $.ajax({
                        url: action,
                        method: method,
                        data: data,
                        dataType: 'json',
                        beforeSend: function() {
                            submit.attr("disabled", true).text("Chờ...");
                        },
                        success: function(json) {
                            if (json.errors) {
                                $.each(json.errors, function(k, v) {
                                    if (v) $(`#${k}-field small`).html(v);
                                    else $(`#${k}-field small`).empty();
                                });
                            } else if (json.success) {
                                $("[id*=-field] small").empty();
                                Snackbar.show(json.alert);
                                location.href = route(route_return);
                            } else {
                                $("[id*=-field] small").empty();
                                Snackbar.show(json.alert);
                            }
                            submit.attr("disabled", false).text(currentText);
                        },
                        error: function(err) {
                            console.error(err);
                            $("[id*=-field] small").empty();
                            Snackbar.show({
                                text: 'Xảy ra lỗi',
                                actionTextColor: '#fff',
                                backgroundColor: '#e7515a',
                                actionText: 'Đóng'
                            });
                            submit.attr("disabled", false).text(currentText);
                        }
                    });
                });
            });
        </script>
        @if ($namePage == 'user.register')
            <script src="{{ asset('plugins/flatpickr/flatpickr.js') }}"></script>
            <script src="https://npmcdn.com/flatpickr/dist/l10n/vn.js"></script>
            <script>
                flatpickr(document.getElementById('date_of_birth'), {
                    minDate: '{{ date('Y-m-d', mktime(0, 0, 0, date('m'), date('d'), date('Y') - 150)) }}',
                    maxDate: '{{ date('Y-m-d', mktime(0, 0, 0, date('m'), date('d'), date('Y') - 10)) }}',
                    locale: 'vn'
                });
            </script>
        @endif
        <script>
            var loaderElement = document.querySelector('#load_screen');
            setTimeout(function() {
                loaderElement.style.display = "none";
            }, 3000);
        </script>
    @break

    @case('admin.post')
        <script src="{{ asset('plugins/table/datatable/datatables.js') }}"></script>
        <script src="{{ asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('plugins/blockui/jquery.blockUI.min.js') }}"></script>
        <script src="{{ asset('assets/js/app.js') }}"></script>
        <script src="{{ asset('assets/js/custom.js') }}"></script>
        <script>
            $(document).ready(function() {
                App.init();
            });

            var tableParent = $(`#list_post_parent`);
            var posts = [];
            var dataTable = $(`#list_post`).DataTable({
                scrollX: true,
                responsive: true,
                search: {
                    smart: false
                },
                columnDefs: [{
                        targets: [0, 1, 11],
                        orderable: false
                    },
                    {
                        targets: 0,
                        width: "25px",
                        className: "",
                        render: function(id) {
                            return `<label class="new-control new-checkbox checkbox-primary" style="height: 21px; margin-bottom: 0; margin-right: 0">\n<input type="checkbox" onchange="select_category(this)" value="${id}" class="new-control-input child-chk">\n <span class="new-control-indicator"></span>\n</label>`;
                        }
                    },
                    {
                        targets: 1,
                        render: function(url) {
                            return `<img src="${url}" style="width:100px;" />`;
                        }
                    }
                ],
                headerCallback: function(e) {
                    e.getElementsByTagName("th")[0].innerHTML =
                        '<label class="new-control new-checkbox checkbox-primary m-auto">\n<input type="checkbox" class="new-control-input chk-parent">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'
                },
                footerCallback: function(e) {
                    e.getElementsByTagName("th")[0].innerHTML =
                        '<label class="new-control new-checkbox checkbox-primary m-auto">\n<input type="checkbox" class="new-control-input chk-parent">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'
                },
                order: [
                    [1, 'asc']
                ],
                oLanguage: {
                    oPaginate: {
                        sPrevious: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                        sNext: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                    },
                    sInfo: "_PAGE_ / _PAGES_",
                    sSearch: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    sSearchPlaceholder: "Tìm kiếm...",
                    sLengthMenu: "_MENU_",
                    sEmptyTable: "Không có dữ liệu",
                    sInfoEmpty: "0 / 0",
                    sZeroRecords: "Không có dữ liệu",
                    sInfoFiltered: " (lọc từ _MAX_ kết quả)"
                }
            });
            multiCheck($("#list_post_parent"), "#list_post_parent");

            function select_post(el) {
                if (el.checked) {
                    if (posts.indexOf(el.value) == -1) {
                        posts.push(el.value);
                    }
                } else {
                    if (posts.indexOf(el.value) != -1) {
                        posts.splice(posts.indexOf(el.value), 1);
                    }
                }
            }

            function blockTable() {
                $(tableParent).block({
                    message: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg>',
                    overlayCSS: {
                        backgroundColor: '#000',
                        backgroundColor: '#000',
                        opacity: 0.8,
                        cursor: 'wait'
                    },
                    css: {
                        border: 0,
                        color: '#fff',
                        padding: 0,
                        backgroundColor: 'transparent'
                    }
                });
            }

            function unblockTable() {
                $(tableParent).unblock();
            }

            function initTable() {
                $.ajax({
                    url: route('api.admin.post.index'),
                    method: 'GET',
                    dataType: 'json',
                    beforeSend: function() {
                        blockTable();
                    },
                    success: function(json) {
                        dataTable.clear();
                        dataTable.rows.add(json);
                        dataTable.draw();
                    },
                    error: function(err) {

                    }
                }).done(function() {
                    unblockTable();
                });
            }
            initTable();
        </script>
    @break

    @case('admin.post.add')
        <script src="{{ asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('plugins/blockui/jquery.blockUI.min.js') }}"></script>
        <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
        <script src="{{ asset('plugins/quill/quill.min.js') }}"></script>

        <script src="{{ asset('assets/js/app.js') }}"></script>
        <script src="{{ asset('assets/js/custom.js') }}"></script>
        <script>
            $(document).ready(function() {
                App.init();

                var quill = new Quill('#post_content', {
                    modules: {
                        formula: true,
                        syntax: true,
                        toolbar: '#toolbar-container'
                    },
                    placeholder: 'Nhập nội dung...',
                    theme: 'snow'
                });

                /*$('#post_category').select2({
                    placeholder: "-- Chọn chuyên mục --",
                    selectionCssClass: 'mb-0'
                });*/

                $("#addPostForm").on("keydown", "#post_title", function() {
                    $("#addPostForm #post_slug").val(str_slug($(this).val()));
                    if ($(this).val().length) {
                        $(`#addPostForm #preview_link`).text(route("post", str_slug($(this).val())));
                    } else {
                        $(`#addPostForm #preview_link`).text(route("post", 'tieu-de'));
                    }
                });

                $("#addPostForm").on("keyup", "#post_title", function() {
                    $("#addPostForm #post_slug").val(str_slug($(this).val()));
                    if ($(this).val().length) {
                        $(`#addPostForm #preview_link`).text(route("post", str_slug($(this).val())));
                    } else {
                        $(`#addPostForm #preview_link`).text(route("post", 'tieu-de'));
                    }
                });

                $("#addPostForm").on("change", "#post_title", function() {
                    $("#addPostForm #post_slug").val(str_slug($(this).val()));
                    if ($(this).val().length) {
                        $(`#addPostForm #preview_link`).text(route("post", str_slug($(this).val())));
                    } else {
                        $(`#addPostForm #preview_link`).text(route("post", 'tieu-de'));
                    }
                });

                $("#addPostForm").on("keydown", "#post_slug", function() {
                    if ($(this).val().length) {
                        $(`#addPostForm #preview_link`).text(route("post", $(this).val()));
                    } else {
                        $(`#addPostForm #preview_link`).text(route("post", 'tieu-de'));
                    }
                });

                $("#addPostForm").on("keyup", "#post_slug", function() {
                    if ($(this).val().length) {
                        $(`#addPostForm #preview_link`).text(route("post", $(this).val()));
                    } else {
                        $(`#addPostForm #preview_link`).text(route("post", 'tieu-de'));
                    }
                });

                $("#addPostForm").on("change", "#post_slug", function() {
                    if ($(this).val().length) {
                        $(`#addPostForm #preview_link`).text(route("post", $(this).val()));
                    } else {
                        $(`#addPostForm #preview_link`).text(route("post", 'tieu-de'));
                    }
                });

                $("#addPostForm").on("submit", function(e) {
                    e.preventDefault();
                    var data = new FormData();
                    data.append("title", $(`#addPostForm #post_title`).val());
                    data.append("slug", $(`#addPostForm #post_slug`).val());
                    data.append("content", quill.root.innerHTML);
                    data.append("category", $(`#addPostForm #post_category`).val());

                    if ($("#addPostForm #post_thumbnail").prop("files").length) {
                        data.append("thumbnail", $("#addPostForm #post_thumbnail").prop("files")[0]);
                    }

                    $.ajax({
                        url: route("api.admin.post.store"),
                        method: "POST",
                        data: data,
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        beforeSend: function() {
                            $($('#addPostForm')).block({
                                message: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg>',
                                overlayCSS: {
                                    backgroundColor: '#000',
                                    opacity: 0.8,
                                    cursor: 'wait'
                                },
                                css: {
                                    border: 0,
                                    color: '#fff',
                                    padding: 0,
                                    backgroundColor: 'transparent'
                                }
                            });
                        },
                        success: function(json) {
                            if (json.errors) {
                                $.each(json.errors, function(k, v) {
                                    if (v) $(`#${k}-field small`).html(v);
                                    else $(`#${k}-field small`).empty();
                                });
                                $($('#addPostForm')).unblock();
                            } else if (json.success) {
                                $("[id*=-field] small").empty();
                                Snackbar.show(json.alert);

                                $($('#addPostForm')).unblock();
                            } else {
                                $("[id*=-field] small").empty();
                                Snackbar.show(json.alert);
                                $($('#addPostForm')).unblock();
                            }
                        },
                        error: function(err) {
                            console.error(err);
                            $("[id*=-field] small").empty();
                            Snackbar.show({
                                text: 'Xảy ra lỗi',
                                actionTextColor: '#fff',
                                backgroundColor: '#e7515a',
                                actionText: "Thử lại",
                                pos: "top-right"
                            });
                            $($('#addPostForm')).unblock();
                        }
                    });
                });

                function str_slug(title) {
                    var slug = title.toLowerCase();

                    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                    slug = slug.replace(/đ/gi, 'd');

                    slug = slug.replace(
                        /\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');

                    slug = slug.replace(/ /gi, "-");

                    slug = slug.replace(/\-\-\-\-\-/gi, '-');
                    slug = slug.replace(/\-\-\-\-/gi, '-');
                    slug = slug.replace(/\-\-\-/gi, '-');
                    slug = slug.replace(/\-\-/gi, '-');

                    slug = '@' + slug + '@';
                    slug = slug.replace(/\@\-|\-\@|\@/gi, '');

                    return slug;
                }
            });
        </script>
    @break

    @case('admin.category')
        <script src="{{ asset('plugins/table/datatable/datatables.js') }}"></script>
        <script src="{{ asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('plugins/blockui/jquery.blockUI.min.js') }}"></script>
        <script src="{{ asset('assets/js/app.js') }}"></script>
        <script src="{{ asset('assets/js/custom.js') }}"></script>
        <script>
            $(document).ready(function() {
                App.init();
            });

            var tableParent = $(`#list_category_parent`);
            var categories = [];
            var dataTable = $(`#list_category`).DataTable({
                scrollX: true,
                responsive: true,
                search: {
                    smart: false
                },
                columnDefs: [{
                        targets: [0, 6],
                        orderable: false
                    },
                    {
                        targets: 0,
                        width: "25px",
                        className: "",
                        render: function(id) {
                            return `<label class="new-control new-checkbox checkbox-primary" style="height: 21px; margin-bottom: 0; margin-right: 0">\n<input type="checkbox" onchange="select_category(this)" value="${id}" class="new-control-input child-chk">\n <span class="new-control-indicator"></span>\n</label>`;
                        }
                    }
                ],
                headerCallback: function(e) {
                    e.getElementsByTagName("th")[0].innerHTML =
                        '<label class="new-control new-checkbox checkbox-primary m-auto">\n<input type="checkbox" class="new-control-input chk-parent">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'
                },
                footerCallback: function(e) {
                    e.getElementsByTagName("th")[0].innerHTML =
                        '<label class="new-control new-checkbox checkbox-primary m-auto">\n<input type="checkbox" class="new-control-input chk-parent">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'
                },
                order: [
                    [1, 'asc']
                ],
                oLanguage: {
                    oPaginate: {
                        sPrevious: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                        sNext: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                    },
                    sInfo: "_PAGE_ / _PAGES_",
                    sSearch: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    sSearchPlaceholder: "Tìm kiếm...",
                    sLengthMenu: "_MENU_",
                    sEmptyTable: "Không có dữ liệu",
                    sInfoEmpty: "0 / 0",
                    sZeroRecords: "Không có dữ liệu",
                    sInfoFiltered: " (lọc từ _MAX_ kết quả)"
                }
            });
            multiCheck($("#list_category_parent"), "#list_category_parent");

            function select_category(el) {
                if (el.checked) {
                    if (categories.indexOf(el.value) == -1) {
                        categories.push(el.value);
                    }
                } else {
                    if (categories.indexOf(el.value) != -1) {
                        categories.splice(categories.indexOf(el.value), 1);
                    }
                }
            }

            function blockTable() {
                $(tableParent).block({
                    message: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg>',
                    overlayCSS: {
                        backgroundColor: '#000',
                        opacity: 0.8,
                        cursor: 'wait'
                    },
                    css: {
                        border: 0,
                        color: '#fff',
                        padding: 0,
                        backgroundColor: 'transparent'
                    }
                });
            }

            function unblockTable() {
                $(tableParent).unblock();
            }

            function initTable() {
                $.ajax({
                    url: route('api.admin.category.index'),
                    method: 'GET',
                    dataType: 'json',
                    beforeSend: function() {
                        //blockTable();
                    },
                    success: function(json) {
                        dataTable.clear();
                        dataTable.rows.add(json);
                        dataTable.draw();
                    },
                    error: function(err) {

                    }
                }).done(function() {
                    unblockTable();
                });
            }

            function confirmDeleteCategory(id, title) {
                $(`#deleteCategoryModal #deleteCatgoryContent`).html(
                    `Bạn có muốn xóa chuyên mục <b>${title}</b> (ID: <b>${id}</b>) không?<br />Điều này sẽ xóa toàn bộ bài viết thuộc chuyên mục này.`
                    );
                $(`#deleteCategoryModal button[type=button]`).off('click');
                $(`#deleteCategoryModal button[type=button]`).on('click', function() {
                    $(`#deleteCategoryModal`).modal('hide');
                    deleteCategory(id);
                });
                $(`#deleteCategoryModal`).modal('show');
            }

            function deleteCategory(id) {
                $.ajax({
                    url: route('api.admin.category.destroy', id),
                    method: 'DELETE',
                    dataType: 'json',
                    beforeSend: function() {
                        blockTable();
                    },
                    success: function(json) {
                        initTable();
                        Snackbar.show(json);
                    },
                    error: function(err) {
                        initTable();
                        console.error(err);
                        Snackbar.show({
                            text: 'Xảy ra lỗi',
                            actionTextColor: '#fff',
                            backgroundColor: '#e7515a',
                            pos: 'top-right',
                            actionText: "Thử lại"
                        });
                    }
                });
            }

            function confirmDeleteMultiCategories() {
                if (categories.length) {
                    $(`#deleteMultiCategoriesModal #deleteMultiCategoriesContent`).html(
                        `Bạn có muốn xóa ${number_format(categories.length)} chuyên mục không?<br />Điều này sẽ xóa toàn bộ bài viết thuộc các chuyên mục này.`
                        );
                    $(`#deleteMultiCategoriesModal`).modal('show');
                } else {
                    Snackbar.show({
                        text: 'Vui lòng chọn chuyên mục',
                        actionTextColor: '#fff',
                        backgroundColor: '#e7515a',
                        pos: 'top-right',
                        actionText: "Đóng"
                    });
                }
            }

            function deleteMultiCategories() {
                $(`#deleteMultiCategoriesModal`).modal('hide');
                $.ajax({
                    url: route('api.admin.category.destroyMulti', categories.join(",")),
                    method: 'DELETE',
                    dataType: 'json',
                    beforeSend: function() {
                        blockTable();
                    },
                    success: function(json) {
                        categories = [];
                        initTable();
                        Snackbar.show(json);
                    },
                    error: function(err) {
                        categories = [];
                        initTable();
                        console.error(err);
                        Snackbar.show({
                            text: 'Xảy ra lỗi',
                            actionTextColor: '#fff',
                            backgroundColor: '#e7515a',
                            pos: 'top-right',
                            actionText: "Thử lại"
                        });
                    }
                });
            }

            blockTable();
            initTable();

            $("#addCategoryModal").on("hidden.bs.modal", function() {
                $(`#addCategoryForm #title`).val("");
                $(`#addCategoryForm #slug`).val("");
                $(`#addCategoryForm #preview_link`).text(route("category", 'tieu-de'));
            });

            $("#addCategoryForm").on("keydown", "#title", function() {
                $("#addCategoryForm #slug").val(str_slug($(this).val()));
                if ($(this).val().length) {
                    $(`#addCategoryForm #preview_link`).text(route("category", str_slug($(this).val())));
                } else {
                    $(`#addCategoryForm #preview_link`).text(route("category", 'tieu-de'));
                }
            });

            $("#addCategoryForm").on("keyup", "#title", function() {
                $("#addCategoryForm #slug").val(str_slug($(this).val()));
                if ($(this).val().length) {
                    $(`#addCategoryForm #preview_link`).text(route("category", str_slug($(this).val())));
                } else {
                    $(`#addCategoryForm #preview_link`).text(route("category", 'tieu-de'));
                }
            });

            $("#addCategoryForm").on("change", "#title", function() {
                $("#addCategoryForm #slug").val(str_slug($(this).val()));
                if ($(this).val().length) {
                    $(`#addCategoryForm #preview_link`).text(route("category", str_slug($(this).val())));
                } else {
                    $(`#addCategoryForm #preview_link`).text(route("category", 'tieu-de'));
                }
            });

            $("#addCategoryForm").on("keydown", "#slug", function() {
                if ($(this).val().length) {
                    $(`#addCategoryForm #preview_link`).text(route("category", $(this).val()));
                } else {
                    $(`#addCategoryForm #preview_link`).text(route("category", 'tieu-de'));
                }
            });

            $("#addCategoryForm").on("keyup", "#slug", function() {
                if ($(this).val().length) {
                    $(`#addCategoryForm #preview_link`).text(route("category", $(this).val()));
                } else {
                    $(`#addCategoryForm #preview_link`).text(route("category", 'tieu-de'));
                }
            });

            $("#addCategoryForm").on("change", "#slug", function() {
                if ($(this).val().length) {
                    $(`#addCategoryForm #preview_link`).text(route("category", $(this).val()));
                } else {
                    $(`#addCategoryForm #preview_link`).text(route("category", 'tieu-de'));
                }
            });

            $("#addCategoryForm").on("submit", function(e) {
                e.preventDefault();
                let submit = $(`#addCategoryModal [type=submit]`);
                let currentText = submit.text();
                $.ajax({
                    url: route("api.admin.category.store"),
                    method: "POST",
                    data: {
                        title: $(`#addCategoryForm #title`).val(),
                        slug: $(`#addCategoryForm #slug`).val()
                    },
                    dataType: 'json',
                    beforeSend: function() {
                        submit.attr("disabled", true).text("Chờ...");
                    },
                    success: function(json) {
                        if (json.errors) {
                            $.each(json.errors, function(k, v) {
                                if (v) $(`#${k}-field small`).html(v);
                                else $(`#${k}-field small`).empty();
                            });
                        } else if (json.success) {
                            $("#addCategoryModal").modal("hide");
                            initTable();
                            $("[id*=-field] small").empty();
                            Snackbar.show(json.alert);
                        } else {
                            $("#addCategoryModal").modal("hide");
                            initTable();
                            $("[id*=-field] small").empty();
                            Snackbar.show(json.alert);
                        }
                        submit.attr("disabled", false).text(currentText);
                    },
                    error: function(err) {
                        console.error(err);
                        $("#addCategoryModal").modal("hide");
                        $("[id*=-field] small").empty();
                        Snackbar.show({
                            text: 'Xảy ra lỗi',
                            actionTextColor: '#fff',
                            backgroundColor: '#e7515a',
                            actionText: "Thử lại",
                            pos: "top-right"
                        });
                        submit.attr("disabled", false).text(currentText);
                    }
                });
            });

            function confirmEditCategory(id) {
                $.ajax({
                    url: route('api.admin.category.edit', id),
                    method: 'GET',
                    dataType: 'json',
                    beforeSend: function() {
                        blockTable();
                    },
                    success: function(json) {
                        if (json.data) {
                            $(`#editCategoryForm #id`).val(id);
                            $(`#editCategoryForm #title`).val(json.data.title);
                            $(`#editCategoryForm #slug`).val(json.data.slug);
                            $(`#editCategoryModal`).modal('show');
                        } else if (json.alert) {
                            Snackbar.show(json.alert);
                        } else {
                            Snackbar.show({
                                text: 'Xảy ra lỗi',
                                actionTextColor: '#fff',
                                backgroundColor: '#e7515a',
                                actionText: "Thử lại",
                                pos: "top-right"
                            });
                        }
                        unblockTable();
                    },
                    error: function(err) {
                        console.error(err);
                        Snackbar.show({
                            text: 'Xảy ra lỗi',
                            actionTextColor: '#fff',
                            backgroundColor: '#e7515a',
                            actionText: "Thử lại",
                            pos: "top-right"
                        });
                        unblockTable();
                    }
                });
            }

            $("#editCategoryModal").on("hidden.bs.modal", function() {
                $(`#editCategoryForm #id`).val("");
                $(`#editCategoryForm #title`).val("");
                $(`#editCategoryForm #slug`).val("");
                $(`#editCategoryForm #preview_link`).text(route("category", 'tieu-de'));
            });

            $("#editCategoryForm").on("keydown", "#title", function() {
                $("#editCategoryForm #slug").val(str_slug($(this).val()));
                if ($(this).val().length) {
                    $(`#editCategoryForm #preview_link`).text(route("category", str_slug($(this).val())));
                } else {
                    $(`#editCategoryForm #preview_link`).text(route("category", 'tieu-de'));
                }
            });

            $("#editCategoryForm").on("keyup", "#title", function() {
                $("#editCategoryForm #slug").val(str_slug($(this).val()));
                if ($(this).val().length) {
                    $(`#editCategoryForm #preview_link`).text(route("category", str_slug($(this).val())));
                } else {
                    $(`#editCategoryForm #preview_link`).text(route("category", 'tieu-de'));
                }
            });

            $("#editCategoryForm").on("change", "#title", function() {
                $("#editCategoryForm #slug").val(str_slug($(this).val()));
                if ($(this).val().length) {
                    $(`#editCategoryForm #preview_link`).text(route("category", str_slug($(this).val())));
                } else {
                    $(`#editCategoryForm #preview_link`).text(route("category", 'tieu-de'));
                }
            });

            $("#editCategoryForm").on("keydown", "#slug", function() {
                if ($(this).val().length) {
                    $(`#editCategoryForm #preview_link`).text(route("category", $(this).val()));
                } else {
                    $(`#editCategoryForm #preview_link`).text(route("category", 'tieu-de'));
                }
            });

            $("#editCategoryForm").on("keyup", "#slug", function() {
                if ($(this).val().length) {
                    $(`#editCategoryForm #preview_link`).text(route("category", $(this).val()));
                } else {
                    $(`#editCategoryForm #preview_link`).text(route("category", 'tieu-de'));
                }
            });

            $("#editCategoryForm").on("change", "#slug", function() {
                if ($(this).val().length) {
                    $(`#editCategoryForm #preview_link`).text(route("category", $(this).val()));
                } else {
                    $(`#editCategoryForm #preview_link`).text(route("category", 'tieu-de'));
                }
            });

            $("#editCategoryForm").on("submit", function(e) {
                e.preventDefault();
                let submit = $(`#editCategoryModal [type=submit]`);
                let currentText = submit.text();
                $.ajax({
                    url: route("api.admin.category.update", $(`#editCategoryForm #id`).val()),
                    method: "PUT",
                    data: {
                        title: $(`#editCategoryForm #title`).val(),
                        slug: $(`#editCategoryForm #slug`).val()
                    },
                    dataType: 'json',
                    beforeSend: function() {
                        submit.attr("disabled", true).text("Chờ...");
                    },
                    success: function(json) {
                        if (json.errors) {
                            $.each(json.errors, function(k, v) {
                                if (v) $(`#${k}-field small`).html(v);
                                else $(`#${k}-field small`).empty();
                            });
                        } else if (json.success) {
                            $("#editCategoryModal").modal("hide");
                            initTable();
                            $("[id*=-field] small").empty();
                            Snackbar.show(json.alert);
                        } else {
                            $("#editCategoryModal").modal("hide");
                            initTable();
                            $("[id*=-field] small").empty();
                            Snackbar.show(json.alert);
                        }
                        submit.attr("disabled", false).text(currentText);
                    },
                    error: function(err) {
                        console.error(err);
                        $("#editCategoryModal").modal("hide");
                        $("[id*=-field] small").empty();
                        Snackbar.show({
                            text: 'Xảy ra lỗi',
                            actionTextColor: '#fff',
                            backgroundColor: '#e7515a',
                            actionText: "Thử lại",
                            pos: "top-right"
                        });
                        submit.attr("disabled", false).text(currentText);
                    }
                });
            });

            function str_slug(title) {
                var slug = title.toLowerCase();

                slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                slug = slug.replace(/đ/gi, 'd');

                slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');

                slug = slug.replace(/ /gi, "-");

                slug = slug.replace(/\-\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-/gi, '-');
                slug = slug.replace(/\-\-/gi, '-');

                slug = '@' + slug + '@';
                slug = slug.replace(/\@\-|\-\@|\@/gi, '');

                return slug;
            }
        </script>
    @break

    @default
        <script src="{{ asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('assets/js/app.js') }}"></script>
        <script>
            $(document).ready(function() {
                App.init();
            });
        </script>
        <script src="{{ asset('assets/js/custom.js') }}"></script>
@endswitch
@if (session('swal'))
<script>
    swal({!! json_encode(session('swal')) !!});
</script>
@endif
