<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class Action extends Controller
{
    public function __construct() {
        parent::__construct();
        $this->namespace = "web.page.user";

    }

    public function profile(Request $request) {
        $this->addBreadcrumb('Hồ sơ cá nhân', route('user.profile'));

        $this->view = "profile";
        $this->namePage = "user.profile";
        $this->title = "Hồ sơ cá nhân";
        $this->data = [];

        return $this->load();
    }

    public function login(Request $request) {
        $this->view = "login";
        $this->namePage = "user.login";
        $this->title = "Đăng nhập";
        $this->data = [];

        return $this->load();
    }

    public function register(Request $request) {
        $this->view = "register";
        $this->namePage = "user.register";
        $this->title = "Đăng ký";
        $this->data = [];

        return $this->load();
    }

    public function active(Request $request, $user_id, $hash) {
        $user = User::find($user_id);

        $check = "{$user->user_id}_{$user->username}_{$user->email}";
        abort_unless(Hash::check($check, $hash), 403);

        if ($user->detail->active) {
            return redirect(route('home'))->with('swal', [
                "title" => "Tài khoản đã được kích hoạt vào lúc " . $user->detail->active_at,
                "type" => "error",
                "confirmButtonText" => "Đóng"
            ]);
        }

        $user->detail->sent_mail_activation_at = null;
        $user->detail->active_at = now();
        $user->detail->active = true;
        $user->detail->save();

        if (Auth::check()) {
            Auth::login($user);
        }

        return redirect(route('home'))->with('swal', [
            "title" => "Kích hoạt thành công",
            "type" => "success",
            "confirmButtonText" => "Đóng"
        ]);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return back();
    }
}
