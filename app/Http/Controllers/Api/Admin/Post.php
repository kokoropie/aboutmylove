<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models;

use Storage;

class Post extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Models\Post::all()->map(function ($item) {
            $editBtn = '<a href="javascript:void(0);" title="Chỉnh sửa"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit text-primary"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></a>';
            $deleteBtn = '<a href="javascript:void(0);" onclick="confirmDeletePost('.$item->category_id.', \''.$item->title.'\')" title="Xóa"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle text-danger"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></a>';
            
            return [
                $item->post_id,
                asset($item->thumbnail),
                $item->title,
                $item->slug,
                $item->content,
                number_format($item->views),
                number_format($item->likes->count()),
                number_format($item->comments->count()),
                $item->user->detail->nickname,
                $item->created_at->format("Y-m-d H:i:s"),
                $item->updated_at->format("Y-m-d H:i:s"),
                $editBtn.$deleteBtn
            ];
        });
        return $posts;
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
        $categories_id = Models\Category::all()->map(function($item) {
            return $item->category_id;
        });

        $msg = [
            "title.required" => "Tiêu đề không được để trống",
            "title.max" => "Tiêu đề tối đa :max ký tự",
            "title.unique" => "Tiêu đề đã tồn tại",
            
            "slug.required" => "Liên kết không được để trống",
            "slug.unique" => "Liên kết đã tồn tại",
            
            "content.required" => "Nội dung không được để trống",
            
            "category.required" => "Vui lòng chọn chuyên mục",
            "category.in" => "Chuyên mục không tồn tại",

            "thumbnail.mimetypes" => "Ảnh bìa phải có định dạng ảnh"
        ];

        $rule = [
            'title' => 'required|max:120|unique:posts,title',
            'content' => 'required',
            'slug' => 'required|unique:posts,slug',
            'category' => 'required|in:' . implode(",", $categories_id->toArray()),
            'thumbnail' => 'mimetypes:image/*'
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
            $post = new Models\Post;
            $post->title = $request->title;
            $post->slug = $request->slug;
            $post->content = $request->content;
            $post->category_id = $request->category;
            $post->user_id = $request->user()->user_id;
            
            if ($post->save()) {
                if ($request->file("thumbnail")) {
                    $path = $request->file('thumbnail')->store('images/upload/' . $request->user()->user_id . '/post/' . $post->post_id);
                    $post->thumbnail = asset("storage/" . $path);
                } else {
                    $post->thumbnail = asset("storage/images/thumbnail.png");
                }

                $return["alert"] = [
                    "text" => "Đăng bài viết thành công",
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
                $return["data"] = $request->all();
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
