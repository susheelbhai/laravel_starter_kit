<?php

namespace Database\Seeders;

use App\Models\UserType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserType::create([
            'user_type_id' => '1',
            'user_type' => 'Admin',
        ]);
        UserType::create([
            'user_type_id' => '2',
            'user_type' => 'Partner',
        ]);
        UserType::create([
            'user_type_id' => '3',
            'user_type' => 'User',
        ]);
    }
}
