<?php

namespace Database\Seeders;

use App\Models\UserGender;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserGenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        include('data/data.php');
        UserGender::insert($user_genders);
    }
}
