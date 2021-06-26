@extends('web.main')

@section('body')
<div class="form-container">
    <div class="form-form">
        <div class="form-form-wrap">
            <div class="form-container">
                <div class="form-content">
                    <h1 class="">Đăng ký tài khoản <a href="{{ route('home') }}"><span class="brand-name">{{ $system->short_title }}</span></a></h1>
                    <p class="signup-link">Đã có tài khoản? <a href="{{ route('user.login') }}">Đăng nhập ngay</a></p>
                    <form class="text-left"  method="POST" data-form="{{ route('api.user.register') }}" data-return="home">
                        <div class="form">
                            <div id="username-field" class="field-wrapper input">
                                <i data-feather="user"></i>
                                <input id="username" name="username" type="text" class="form-control" placeholder="Tài khoản" />
                                <small class="text-danger"></small>
                            </div>
                            
                            <div id="email-field" class="field-wrapper input">
                                <i data-feather="at-sign"></i>
                                <input id="email" name="email" type="email" class="form-control" placeholder="Email" />
                                <small class="text-danger"></small>
                            </div>
                            
                            <div id="phone-field" class="field-wrapper input">
                                <i data-feather="phone"></i>
                                <input id="phone" name="phone" type="tel" class="form-control" placeholder="Số điện thoại" />
                                <small class="text-danger"></small>
                            </div>

                            <div id="password-field" class="field-wrapper input mb-2">
                                <i data-feather="lock"></i>
                                <input id="password" name="password" type="password" class="form-control" placeholder="Mật khẩu">
                                <small class="text-danger"></small>
                            </div>

                            <div id="password_confirmed-field" class="field-wrapper input mb-2">
                                <i data-feather="lock"></i>
                                <input id="password_confirmed" name="password_confirmed" type="password" class="form-control" placeholder="Xác minh mật khẩu">
                                <small class="text-danger"></small>
                            </div>

                            <div id="gender-field" class="field-wrapper input mb-2">
                                <select class="form-control selectpicker" name="gender">
                                    <option value="male">Nam</option>
                                    <option value="female">Nữ</option>
                                    <option value="hide">Ẩn</option>
                                </select>
                                <small class="text-danger"></small>
                            </div>

                            <div id="date_of_birth-field" class="field-wrapper input mb-2">
                                <input type="text" name="date_of_birth" class="form-control flatpickr flatpickr-input active" id="date_of_birth" placeholder="Ngày sinh" />
                                <small class="text-danger"></small>
                            </div>

                            <div class="field-wrapper terms_condition" id="terms_condition-field">
                                <div class="n-chk new-checkbox checkbox-outline-primary">
                                    <label class="new-control new-checkbox checkbox-outline-primary">
                                        <input type="checkbox" class="new-control-input" name="terms_condition" value="1">
                                        <span class="new-control-indicator"></span><span>Tôi đồng ý với <a href="javascript:void(0);">các điều khoản và điều kiện</a></span>
                                    </label>
                                </div>
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
                                    <button type="submit" class="btn btn-primary" value="">Đăng ký</button>
                                </div>
                            </div>

                        </div>
                    </form>                        
                    <p class="terms-conditions">Copyright © 2021<br /><a href="{{ route('home') }}">{{ $system->short_title }}</a> là sản phẩm của <a href="javascript:void(0)">Kaga</a><br /><a href="javascript:void(0);">Chính sách Cookie</a>, <a href="javascript:void(0);">Quyền riêng tư và điều khoản</a>.</p>
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