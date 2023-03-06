<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Setting::create([
            

            'app_name' => 'S Commerse',
            'favicon' => 'dummy.png',
            'dark_logo' => 'dummy.png',
            'light_logo' => 'dummy.png',
            'title' => 'Dummy',
            'address' => 'Dummy',
            'detailed_address' => 'Dummy',
            'email' => 'example@email.com',
            'phone' => 'Dummy',
            'short_description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis, fugit laborum repellendus accusamus fugiat atque,',
            'facebook' => 'Dummy',
            'instagram' => 'Dummy',
            'linkedin' => 'Dummy',
            'twitter' => 'Dummy',
            'google_map' => 'Dummy',
            'whatsapp' => 'Dummy',
            'admin_theme' => 'theme1',
            'user_theme' => 'theme2',
            'partner_theme' => 'theme1',
            'color1' => 'green',
            'color2' => '#f5f6ff',
            'color3' => 'red',
        ]);
    }
}
