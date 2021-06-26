<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NavbarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nav = new \App\Models\Navbar;
        $nav->title = "Trang chủ";
        $nav->url = json_encode(["route" => "home"]);
        $nav->icon = "home";
        $nav->ref = "home";
        $nav->save();

    }
}
