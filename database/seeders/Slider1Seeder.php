<?php

namespace Database\Seeders;

use App\Models\Slider1;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Slider1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        include('data/data.php');
        Slider1::insert($slider1);
    }
}
