<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Str;

class Home extends Controller
{
    public function __construct() {
        parent::__construct();
        $this->namespace = "web.page";
        $this->addBreadcrumb($this->system->short_title, route('home'));
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $this->view = "home";
        $this->namePage = "home";
        $this->title = "Trang Chủ";
        $this->active = ["home"];
        $this->data = [];

        return $this->load();
    }

    public function admin(Request $request)
    {
        $this->addBreadcrumb('Trang quản trị', route('admin'));

        $this->view = "admin.index";
        $this->namePage = "admin";
        $this->title = "Trang quản trị";
        $this->active = ["admin", "index"];
        $this->data = [];

        return $this->load();
    }

    public function changeTheme(Request $request, $theme) {
        if ($theme == "dark") {
            session(['theme' => 'dark']);
        } else {
            session(['theme' => 'light']);
        }
        if (Auth::check()) {
            $user = Auth::user();
            $user->detail->dark_mode = $theme == "dark";
            $user->detail->save();
        }
        return session('theme');
    }

    public function test(Request $request) {
        
    }

    public function install(Request $request) {
        //file_put_contents(database_path("database.sqlite"), "");
        sleep(5);
        \Artisan::call('migrate:refresh --seed');
        dd(\Artisan::output());
    }
}
