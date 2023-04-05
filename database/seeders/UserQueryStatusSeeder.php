<?php

namespace Database\Seeders;

use App\Models\UserQueryStatus;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserQueryStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        include('data/data.php');
        UserQueryStatus::insert($user_query_statuses);
        
        
    }
}
