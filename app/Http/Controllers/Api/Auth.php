<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth as F_Auth;

use App\Models\User;

class Auth extends Controller
{
    public function login(Request $request) {
        $msg = [
            "username.required" => "Tài khoản/Email không được để trống",

            "password.required" => "Mật khẩu không được để trống",
        ];

        $rule = [
            'username' => 'required',
            'password' => 'required',
        ];

        $keys = array_keys($rule);
        $return = [];

        $validator = Validator::make($request->all(), $rule, $msg);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $return["errors"] = [];
            foreach ($keys as $key) {
                if ($errors->has($key)) {
                    $return["errors"][$key] = $errors->first($key);
                } else {
                    $return["errors"][$key] = null;
                }
            }
        } else {
            if (F_Auth::attempt(['username' => $request->username, 'password' => $request->password]) || F_Auth::attempt(['email' => $request->username, 'password' => $request->password])) {
                $user = F_Auth::user();
                if (Hash::needsRehash($user->password)) {
                    $user->password = bcrypt($request->password);
                    $user->save();
                }
                F_Auth::login($user);
                $return["success"] = true;
                $return["alert"] = [
                    "text" => "Đăng nhập thành công",
                    "actionTextColor" => '#fff',
                    "backgroundColor" => '#8dbf42',
                    "showAction" => false
                ];
            } else {
                $return["alert"] = [
                    "text" => "Tài khoản/Email hoặc mật khẩu không chính xác",
                    "actionTextColor" => '#fff',
                    "backgroundColor" => '#e7515a',
                    "actionText" => "Thử lại"
                ];
            }
        }

        return $return;
    }

    public function register(Request $request) {
        $msg = [
            "username.required" => "Tài khoản không được để trống",
            "username.alpha_num" => "Tài khoản chỉ nhận ký tự chữ cái và số",
            "username.min" => "Tài khoản có độ dài tối thiểu :min ký tự",
            "username.max" => "Tài khoản có độ dài tối đa :max ký tự",
            "username.unique" => "Tài khoản đã tồn tại",

            "email.required" => "Email không được để trống",
            "email.email" => "Email không đúng định dạng",
            "email.unique" => "Email đã tồn tại",

            "phone.required" => "Số điện thoại không được để trống",
            "phone.numeric" => "Số điện thoại không đúng định dạng",
            "phone.min" => "Số điện thoại không đúng định dạng",
            "phone.max" => "Số điện thoại không đúng định dạng",
            "phone.unique" => "Số điện thoại đã tồn tại",

            "password.required" => "Mật khẩu không được để trống",
            "password.min" => "Mật khẩu có độ dài tối thiểu :min ký tự",
            "password.max" => "Mật khẩu có độ dài tối da :max ký tự",

            "password_confirmed.required" => "Mật khẩu xác minh không được để trống",
            "password_confirmed.same" => "Mật khẩu xác minh phải giống mật khẩu",

            "gender.required" => "Vui lòng chọn giới tính",
            "gender.in" => "Giới tính không tồn tại",

            "date_of_birth.required" => "Vui lòng chọn ngày sinh",
            "date_of_birth.date" => "Ngày sinh không đúng định dạng",

            "terms_condition.required" => "Bạn phải đồng ý với các điều khoản và điều kiện",
        ];

        $rule = [
            'username' => 'required|alpha_num|min:5|max:30|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|min:10|numeric||unique:users,phone',
            'password' => 'required|min:6|max:60',
            'password_confirmed' => 'required|same:password',
            'gender' => 'required|in:male,female,hide',
            'date_of_birth' => 'required|date',
            'terms_condition' => 'required'
        ];

        $keys = array_keys($rule);
        $return = [];

        $validator = Validator::make($request->all(), $rule, $msg);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $return["errors"] = [];
            foreach ($keys as $key) {
                if ($errors->has($key)) {
                    $return["errors"][$key] = $errors->first($key);
                } else {
                    $return["errors"][$key] = null;
                }
            }
        } else {
            $user = new User;
            $user->username = strtolower($request->username);
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = bcrypt($request->password);
            $user->gender = $request->gender;
            $user->date_of_birth = $request->date_of_birth;
            $user->ip = $request->ip();
            if ($user->save()) {
                F_Auth::login($user);
                $return["alert"] = [
                    "text" => "Đăng ký thành công",
                    "actionTextColor" => '#fff',
                    "backgroundColor" => '#8dbf42',
                    "showAction" => false
                ];
            } else {
                $return["alert"] = [
                    "text" => "Xảy ra lỗi",
                    "actionTextColor" => '#fff',
                    "backgroundColor" => '#e7515a',
                    "actionText" => "Thử lại"
                ];
            }
        }

        return $return;
    }

    public function send_email_active() {
        if (F_Auth::check()) {
            $user = F_Auth::user();
            if ($user->detail->active) {
                $hash = bcrypt("{$user->user_id}_{$user->username}_{$user->email}");
                \Mail::to($user->email)
                    ->send(new \App\Mail\User\Active($user, route('user.active', [
                        "user_id" => $user->user_id,
                        "hash" => $hash
                    ]
                ), $short_title->content));

                $return["alert"] = [
                    "text" => "Gửi liên kết kích hoạt thành công",
                    "actionTextColor" => '#fff',
                    "backgroundColor" => '#e7515a',
                    "actionText" => "Thử lại"
                ];
            } else {
                $return["alert"] = [
                    "text" => "Tài khoản đã được kích hoạt thành công vào " . $user->detail->active_at->format("Y-m-d H:i:s"),
                    "actionTextColor" => '#fff',
                    "backgroundColor" => '#e7515a',
                    "actionText" => "Thử lại"
                ];
            }
        } else {
            $return["alert"] = [
                "text" => "Vui lòng đăng nhập",
                "actionTextColor" => '#fff',
                "backgroundColor" => '#e7515a',
                "actionText" => "Thử lại"
            ];
        }
    }
}
