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
        UserGender::create([
            'gender_id' => '1',
            'gender' => 'Male',
        ]);
        UserGender::create([
            'gender_id' => '2',
            'gender' => 'Female',
        ]);
        UserGender::create([
            'gender_id' => '3',
            'gender' => 'Others',
        ]);
    }
}
