<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;

use Illuminate\Routing\Controller as BaseController;

use App\Models\System;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $title = "";
    public $namePage = "";
    public $namespace = "";
    public $view = "";
    public $data = [];
    public $active = [];
    public $breadcrumb = [];
    public $system = [];

    public function __construct() {
        $this->system = (object) System::all()->mapWithKeys(function ($item) {
            return [$item->name => $item->content];
        })->all();
    }

    public function addBreadcrumb ($title, $url) {
        $this->breadcrumb[] = [
            "title" => $title,
            "url" => $url
        ];
    }

    protected function load() {
        $data = [
            "title" => $this->title,
            "namePage" => $this->namePage,
            "active" => $this->active,
            "breadcrumb" => $this->breadcrumb
        ];
        
        if (Auth::check()) {
            $user = Auth::user();
            session(['theme' => $user->detail->dark_mode ? "dark" : "light"]);
            \View::share('user', $user);
        }
        
        if (!session()->has("theme")) {
            session(['theme' => 'light']);
        }

        \View::share('theme', session('theme'));
        \View::share('system', $this->system);

        foreach ($this->data as $key => $value) {
            $data[$key] = $value;
        }

        $view = trim($this->namespace . "." . $this->view, ".");
        return view($view, $data);
    }
}
