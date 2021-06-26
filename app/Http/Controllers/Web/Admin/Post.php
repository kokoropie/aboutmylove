<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models;

class Post extends Controller
{
    public function __construct() {
        parent::__construct();
        $this->namespace = "web.page.admin.post";
        $this->addBreadcrumb($this->system->short_title, route('home'));
        $this->addBreadcrumb('Trang quản trị', route('admin'));
    }

    public function __invoke(Request $request) {
        $this->addBreadcrumb('Danh sách bài viết', route('admin.post'));

        $this->view = "index";
        $this->namePage = "admin.post";
        $this->title = "Danh sách bài viết";
        $this->active = ["admin", "post", "index"];
        $this->data = [];

        return $this->load();
    }

    public function add(Request $request) {
        $this->addBreadcrumb('Quản lý bài viết', route('admin.post'));
        $this->addBreadcrumb('Thêm bài viết', route('admin.post.add'));


        $this->view = "add";
        $this->namePage = "admin.post.add";
        $this->title = "Thêm bài viết";
        $this->active = ["admin", "post", "add"];
        $this->data = [
            "categories" => Models\Category::orderBy("title", "asc")->get()
        ];

        return $this->load();

    }
}
