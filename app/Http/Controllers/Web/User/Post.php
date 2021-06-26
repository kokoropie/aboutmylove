<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Post extends Controller
{
    public function __construct() {
        parent::__construct();
        $this->namespace = "web.page.user.post";
        $this->addBreadcrumb($this->system->short_title, route('home'));
    }

    public function add(Request $request) {
        //$this->addBreadcrumb('Quản lý bài viết', route('admin.post'));
        $this->addBreadcrumb('Thêm bài viết', route('user.post.add'));


        $this->view = "add";
        $this->namePage = "user.post.add";
        $this->title = "Thêm bài viết";
        $this->active = ["user", "post", "add"];
        $this->data = [];

        return $this->load();
    }
}
