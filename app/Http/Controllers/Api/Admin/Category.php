<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models;

class Category extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Models\Category::all()->map(function ($item) {
            $editBtn = '<a href="javascript:void(0);" onclick="confirmEditCategory('.$item->category_id.', \''.$item->title.'\', \''.$item->slug.'\')" title="Chỉnh sửa"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit text-primary"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></a>';
            $deleteBtn = '<a href="javascript:void(0);" onclick="confirmDeleteCategory('.$item->category_id.', \''.$item->title.'\')" title="Xóa"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle text-danger"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></a>';
            
            return [
                $item->category_id,
                $item->title,
                $item->slug,
                number_format($item->posts->count()),
                $item->created_at->format("Y-m-d H:i:s"),
                $item->updated_at->format("Y-m-d H:i:s"),
                $editBtn.$deleteBtn
            ];
        });
        return $categories;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $msg = [
            "title.required" => "Tiêu đề không được để trống",
            "title.max" => "Tiêu đề tối đa :max ký tự",
            "title.unique" => "Tiêu đề đã tồn tại",
            
            "slug.required" => "Liên kết không được để trống",
            "slug.unique" => "Liên kết đã tồn tại",
        ];

        $rule = [
            'title' => 'required|max:120|unique:categories,title',
            'slug' => 'required|unique:categories,slug',
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
            $category = new Models\Category;
            $category->title = $request->title;
            $category->slug = $request->slug;
            if ($category->save()) {
                $return["alert"] = [
                    "text" => "Tạo chuyên mục thành công",
                    "actionTextColor" => '#fff',
                    "backgroundColor" => '#8dbf42',
                    "actionText" => "Đóng",
                    "pos" => "top-right"
                ];
            } else {
                $return["alert"] = [
                    "text" => "Xảy ra lỗi",
                    "actionTextColor" => '#fff',
                    "backgroundColor" => '#e7515a',
                    "actionText" => "Thử lại",
                    "pos" => "top-right"
                ];
            }
        }
        return $return;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Models\Category::find($id);
        if ($category) {
            return [
                "data" => [
                    "title" => $category->title,
                    "slug" => $category->slug
                ],
                "alert" => null
            ];
        } else {
            return [
                "data" => null,
                "alert" => [
                    "text" => "Chuyên mục không tồn tại!",
                    "actionTextColor" => '#fff',
                    "backgroundColor" => '#e7515a',
                    "pos" => "top-right",
                    "actionText" => "Thử lại"
                ]
            ];
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $msg = [
            "title.required" => "Tiêu đề không được để trống",
            "title.max" => "Tiêu đề tối đa :max ký tự",
            "title.unique" => "Tiêu đề đã tồn tại",
            
            "slug.required" => "Liên kết không được để trống",
            "slug.unique" => "Liên kết đã tồn tại",
        ];

        $rule = [
            'title' => 'required|max:120|unique:categories,title',
            'slug' => 'required|unique:categories,slug',
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
            $category = Models\Category::find($id);
            if ($category) {
                $category->title = $request->title;
                $category->slug = $request->slug;
                if ($category->save()) {
                    $return["alert"] = [
                        "text" => "Cập nhật chuyên mục thành công",
                        "actionTextColor" => '#fff',
                        "backgroundColor" => '#8dbf42',
                        "actionText" => "Đóng",
                        "pos" => "top-right"
                    ];
                } else {
                    $return["alert"] = [
                        "text" => "Xảy ra lỗi",
                        "actionTextColor" => '#fff',
                        "backgroundColor" => '#e7515a',
                        "actionText" => "Thử lại",
                        "pos" => "top-right"
                    ];
                }
            } else {
                $return["alert"] = [
                    "text" => "Chuyên mục không tồn tại",
                    "actionTextColor" => '#fff',
                    "backgroundColor" => '#8dbf42',
                    "actionText" => "Đóng",
                    "pos" => "top-right"
                ];

            }
        }
        return $return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Models\Category::find($id);
        if ($category) {
            Models\Post::where("category_id", $id)->delete();
            $category->delete();
            return [
                "text" => "Xóa chuyên mục thành công!",
                "actionTextColor" => '#fff',
                "backgroundColor" => '#8dbf42',
                "pos" => "top-right",
                "actionText" => "Đóng"
            ];
        } else {
            return [
                "text" => "Chuyên mục không tồn tại!",
                "actionTextColor" => '#fff',
                "backgroundColor" => '#e7515a',
                "pos" => "top-right",
                "actionText" => "Thử lại"
            ];
        }
    }

    public function destroyMulti($categories) {
        $ids = explode(",", $categories);
        $count = 0;
        foreach ($ids as $id) {
            $category = Models\Category::find($id);
            if ($category) {
                Models\Post::where("category_id", $id)->delete();
                $category->delete();
                $count++;
            }
        }
        return [
            "text" => "Xóa thành công " . number_format($count) . " chuyên mục!",
            "actionTextColor" => '#fff',
            "backgroundColor" => '#8dbf42',
            "pos" => "top-right",
            "actionText" => "Đóng"
        ];
    }
}
