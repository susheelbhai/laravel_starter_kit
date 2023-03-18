<?php

namespace Database\Seeders;

use App\Models\PageHome;
use App\Models\PageAbout;
use App\Models\PageContact;
use App\Models\ImportantLink;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        PageHome::create(['id'=>1]);
        PageAbout::create(['id'=>1]);
        PageContact::create(['id'=>1]);
    }
}
