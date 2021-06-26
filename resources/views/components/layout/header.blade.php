<!--  BEGIN NAVBAR  -->
<div class="header-container">
    <header class="header navbar navbar-expand-sm">
        <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom">
            <i data-feather="menu"></i>
        </a>

        <div class="nav-logo align-self-center">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img alt="logo" src="{{ asset('assets/img/logo.png') }}" /> 
                <span class="navbar-brand-name">{{ $system->short_title }}</span>
            </a>
        </div>

        <ul class="navbar-item topbar-navigation">
            
            <!--  BEGIN TOPBAR  -->
            <div class="topbar-nav header navbar" role="banner">
                <nav id="topbar">
                    <ul class="navbar-nav theme-brand flex-row  text-center">
                        <li class="nav-item theme-logo">
                            <a href="{{ route('home') }}">
                                <img src="{{ asset('assets/img/logo.png') }}" class="navbar-logo" alt="logo">
                            </a>
                        </li>
                        <li class="nav-item theme-text">
                            <a href="{{ route('home') }}" class="nav-link">{{ $system->short_title }}</a>
                        </li>
                    </ul>
                    <x-layout::navbar :active="$activeNavbar" />
                </nav>
            </div>
            <!--  END TOPBAR  -->
        </ul>
        <ul class="navbar-item flex-row ml-auto">
            <li class="nav-item align-self-center search-animated">
                <i class="toggle-search" data-feather="search"></i>
                <form class="form-inline search-full form-inline search" role="search">
                    <div class="search-bar">
                        <input type="text" class="form-control search-form-control  ml-lg-auto" placeholder="Tìm kiếm..." />
                    </div>
                </form>
            </li>
        </ul>
        <ul class="navbar-item flex-row nav-dropdowns">
            <li class="nav-item dropdown user-profile-dropdown order-lg-0 order-1">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="user-profile-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media">
                        <img src="{{ asset('assets/img/90x90.jpg') }}" class="img-fluid" alt="admin-profile">
                    </div>
                </a>
                @if (\Auth::check())
                <div class="dropdown-menu position-absolute animated fadeInUp" aria-labelledby="userProfileDropdown">
                    <div class="user-profile-section">
                        <div class="media mx-auto">
                            <img src="{{ asset('assets/img/90x90.jpg') }}" class="img-fluid mr-2" alt="avatar">
                            <div class="media-body">
                                <h5>{{ $user->detail->nickname }}</h5>
                                <p>{{ $user->detail->signature }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-item">
                        <a href="{{ route('user.profile') }}">
                            <i data-feather="info"></i> <span>Hồ sơ cá nhân</span>
                        </a>
                    </div>
                    @if ($user->detail->permission == "author")
                    <div class="dropdown-item">
                        <a href="{{ route('user.profile') }}">
                            <i data-feather="list"></i> <span>Quản lý bài viết</span>
                        </a>
                    </div>
                    @elseif ($user->detail->permission == "moderator" || $user->detail->permission == "administrator")
                    <div class="dropdown-item">
                        <a href="{{ route('admin.post') }}">
                            <i data-feather="list"></i> <span>Quản lý bài viết</span>
                        </a>
                    </div>
                    <div class="dropdown-item">
                        <a href="{{ route('admin') }}">
                            <i data-feather="sliders" class="text-danger"></i> <span class="text-danger">Trang quản trị</span>
                        </a>
                    </div>
                    @endif
                    <div class="dropdown-item">
                        <a href="{{ route('user.logout') }}">
                            <i data-feather="log-out"></i> <span>Đăng xuất</span>
                        </a>
                    </div>
                </div>
                @else
                <style>
                    .header-container .navbar .navbar-item .nav-item.dropdown .dropdown-menu:after {
                        display: none;
                    }
                </style>
                <div class="dropdown-menu animated fadeInUp" aria-labelledby="userProfileDropdown">
                    <div class="dropdown-item">
                        <a href="{{ route('user.login') }}">
                            <i data-feather="log-in"></i> <span>Đăng nhập</span>
                        </a>
                    </div>
                    <div class="dropdown-item">
                        <a href="{{ route('user.register') }}">
                            <i data-feather="log-in"></i> <span>Đăng ký</span>
                        </a>
                    </div>
                </div>
                @endif
            </li>
        </ul>
    </header>
</div>
<!--  END NAVBAR  -->