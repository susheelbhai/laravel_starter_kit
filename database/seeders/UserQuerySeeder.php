<?php

namespace Database\Seeders;

use App\Models\UserQuery;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserQuerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        include('data/data.php');
        UserQuery::insert($user_queries);
    }
}
