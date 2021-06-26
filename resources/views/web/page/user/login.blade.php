@extends('web.main')

@section('body')
<div class="form-container">
    <div class="form-form">
        <div class="form-form-wrap">
            <div class="form-container">
                <div class="form-content">
                    <h1 class="">Đăng nhập tài khoản <a href="{{ route('home') }}"><span class="brand-name">{{ $system->short_title }}</span></a></h1>
                    <p class="signup-link">Chưa có tài khoản? <a href="{{ route('user.register') }}">Đăng ký tại đây</a></p>
                    <form class="text-left"  method="POST" data-form="{{ route('api.user.login') }}" data-return="home">
                        <div class="form">
                            <div id="username-field" class="field-wrapper input">
                                <i data-feather="user"></i>
                                <input id="username" name="username" type="text" class="form-control" placeholder="Tài khoản/Email" />
                                <small class="text-danger"></small>
                            </div>

                            <div id="password-field" class="field-wrapper input mb-2">
                                <i data-feather="lock"></i>
                                <input id="password" name="password" type="password" class="form-control" placeholder="Mật khẩu">
                                <small class="text-danger"></small>
                            </div>
                            <div class="d-sm-flex justify-content-between">
                                <div class="field-wrapper toggle-pass">
                                    <p class="d-inline-block">Hiện mật khẩu</p>
                                    <label class="switch s-primary">
                                        <input type="checkbox" id="toggle-password" class="d-none">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                                <div class="field-wrapper">
                                    <button type="submit" class="btn btn-primary" value="">Đăng nhập</button>
                                </div>
                            </div>

                            <div class="field-wrapper">
                                <a href="{{ route('home') }}" class="forgot-pass-link">Quên mật khẩu?</a>
                            </div>

                        </div>
                    </form>                        
                    <p class="terms-conditions">Copyright © 2021<br /><a href="{{ route('home') }}">{{ $system->short_title }}</a> là sản phẩm của Kaga. <br /><a href="javascript:void(0);">Chính sách Cookie</a>, <a href="javascript:void(0);">Quyền riêng tư và điều khoản</a>.</p>

                </div>                    
            </div>
        </div>
    </div>
    <div class="form-image">
        <div class="l-image">
        </div>
    </div>
</div>
@endsection