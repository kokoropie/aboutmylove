<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models;

class Category extends Controller
{
    public function __construct() {
        parent::__construct();
        $this->namespace = "web.page.admin.category";
        $this->addBreadcrumb($this->system->short_title, route('home'));
        $this->addBreadcrumb('Trang quản trị', route('admin'));
    }

    public function __invoke(Request $request) {
        $this->addBreadcrumb('Danh sách chuyên mục', route('admin.category'));

        $this->view = "index";
        $this->namePage = "admin.category";
        $this->title = "Danh sách chuyên mục";
        $this->active = ["admin", "category", "index"];

        $categories = Models\Category::all()->map(function($item) {
            return [
                $item->title,
                $item->created_at->format("Y-m-d H:i:s"),
                $item->updated_at->format("Y-m-d H:i:s"),
                [
                    "id" => $item->category_id,
                    "title" => $item->title
                ]
            ];
        });
        
        $this->data = [
            "categories" => $categories
        ];

        return $this->load();
    }
}
