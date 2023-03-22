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
        UserQueryStatus::insert(
            array(
                array(
                    'id' => '1',
                    'name' => 'Unread',
                ),
                array(
                    'id' => '2',
                    'name' => 'Viewd',
                ),
                array(
                    'id' => '3',
                    'name' => 'Spam',
                ),
                array(
                    'id' => '4',
                    'name' => 'Responded',
                ),
                array(
                    'id' => '5',
                    'name' => 'Closed',
                ),
            )
        );
        
        
    }
}
