<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Navbar extends Model
{
    use HasFactory;
    protected $table = "navbars";
    protected $primaryKey = 'navbar_id';
    public $timestamps = false;
    
    protected $attributes = [
        "icon" => "box",
        "url" => "{}"
    ];
}
