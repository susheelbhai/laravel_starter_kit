<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserQueryStatus;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserQueryStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        include('data/data.php');
        UserQueryStatus::insert($user_query_statuses);
    }
}
