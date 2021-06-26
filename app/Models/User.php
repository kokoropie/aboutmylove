<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;
    protected $table = "users";
    protected $primaryKey = 'user_id';

    public function detail() {
        return $this->hasOne(UserDetail::class, "username", "username");
    }

    public function posts() {
        return $this->hasMany(Post::class, "user_id", "user_id");
    }

    public function comments() {
        return $this->hasMany(Comment::class, "user_id", "user_id");
    }

    public function likes() {
        return $this->hasMany(Comment::class, "user_id", "user_id");
    }

    protected static function booted()
    {
        static::created(function ($user) {
            $new = new UserDetail;
            $new->username = $user->username;
            $new->nickname = $user->username;
            $new->dark_mode = session("theme") == "dark";
            $new->signature = "Meow~";
            $new->sent_mail_activation_at = now();
            $new->save();

            $short_title = System::find('short_title');

            $hash = bcrypt("{$user->user_id}_{$user->username}_{$user->email}");
            \Mail::to($user->email)
                ->send(new \App\Mail\User\Active($user, route('user.active', [
                    "user_id" => $user->user_id,
                    "hash" => $hash
                ]), $short_title->content));
        });
    }
}
