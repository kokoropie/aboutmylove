<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    protected $table = "likes";
    protected $primaryKey = 'like_id';

    public function user() {
        return $this->hasOne(User::class, "user_id", "user_id");
    }

    public function post() {
        return $this->hasOne(Post::class, "post_id", "post_id");
    }

    public function comment() {
        return $this->hasOne(Comment::class, "comment_id", "comment_id");
    }
}
