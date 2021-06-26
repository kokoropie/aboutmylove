<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = "comments";
    protected $primaryKey = 'comment_id';

    public function user() {
        return $this->hasOne(User::class, "user_id", "user_id");
    }

    public function post() {
        return $this->hasOne(Post::class, "post_id", "post_id");
    }

    public function comments() {
        return $this->hasMany(Comment::class, "by_id", "comment_id");
    }

    public function likes() {
        return $this->hasMany(Like::class, "comment_id", "comment_id");
    }
}
