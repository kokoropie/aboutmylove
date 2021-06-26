<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\System::insert([
            ["name" => "title", "content" => "About My Love"],
            ["name" => "description", "content" => "About My Love"],
            ["name" => "keywords", "content" => "about,my,love"],
            ["name" => "short_title", "content" => "About My Love"]
        ]);
    }
}
