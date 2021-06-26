<!-- loader -->
<link href="{{ asset('assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('assets/js/loader.js') }}"></script>

<!-- global -->
<link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
<link href="{{ asset('plugins/font-icons/fontawesome/css/regular.css') }}" rel="stylesheet" />
<link href="{{ asset('plugins/font-icons/fontawesome/css/fontawesome.css') }}"rel="stylesheet" />
<link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/sweetalerts/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/sweetalerts/sweetalert.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/components/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/elements/popover.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/notification/snackbar/snackbar.min.css') }}" rel="stylesheet" type="text/css" />

<script src="{{ asset('plugins/sweetalerts/promise-polyfill.js') }}"></script>
<!-- {{ $namePage }} -->
@switch($namePage)
    @case('user.login')
    @case('user.register')
        <link href="{{ asset('assets/css/authentication/form-1.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/forms/theme-checkbox-radio.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/forms/switches.css') }}" rel="stylesheet" type="text/css" />
        @if ($namePage == "user.register")
        <link href="{{ asset('plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('plugins/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css" />
        @endif
    @break

    @case('user.profile')
        <link href="{{ asset('assets/css/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
    @break

    @case('admin')
    @case('admin.post')
    @case('admin.category')
        <link href="{{ asset('plugins/table/datatable/datatables.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('plugins/table/datatable/dt-global_style.css') }}"rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/components/custom-list-group.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('plugins/animate/animate.css') }}" rel="stylesheet" type="text/css" />
    @break

    @case('admin.post.add')
        <link href="{{ asset('assets/css/components/custom-list-group.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('plugins/animate/animate.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />

        <link href="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.css" rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/monokai-sublime.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('plugins/editors/quill/quill.snow.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('plugins/quill/quill.bubble.css')}}" rel="stylesheet" type="text/css" />
    @break

    @default
        <link href="{{ asset('assets/css/elements/alert.css') }}" rel="stylesheet" type="text/css" />
@endswitch
<style class="light-theme">
    .widget-one-content-area {
        background-color: #f1f2f3;
    }
    /*
        The below code is for DEMO purpose --- Use it if you are using this demo otherwise Remove it
    */
    .layout-px-spacing {
        min-height: calc(100vh - 122px)!important;
    }
    .topbar-nav.header nav#topbar ul.menu-categories li.menu .submenu {
        top: 54px;
    }
    .header-container .navbar .navbar-item .nav-item.dropdown .dropdown-menu {
        top: 49px;
    }

    @media (min-width: 1200px) {
        .shadow-icons {
            position: absolute;
            left: 18px;
            top: 18px;
        }
    }

</style>

<style class="dark-theme">
    /*
        The below code is for DEMO purpose --- Use it if you are using this demo otherwise Remove it
    */
    .layout-px-spacing {
        min-height: calc(100vh - 122px)!important;
    }
    .topbar-nav.header nav#topbar ul.menu-categories li.menu .submenu {
        top: 54px;
    }
    .header-container .navbar .navbar-item .nav-item.dropdown .dropdown-menu {
        top: 49px;
    }

    @media (min-width: 1200px) {
        .shadow-icons {
            position: absolute;
            left: 18px;
            top: 18px;
        }
    }

</style>