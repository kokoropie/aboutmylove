<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = "posts";
    protected $primaryKey = 'post_id';

    public function user() {
        return $this->hasOne(User::class, "user_id", "user_id");
    }

    public function category() {
        return $this->hasOne(Category::class, "category_id", "category_id");
    }

    public function comments() {
        return $this->hasMany(Comment::class, "post_id", "post_id");
    }

    public function likes() {
        return $this->hasMany(Like::class, "post_id", "post_id");
    }
}
