<?php

namespace Database\Seeders;

use App\Models\PageTnc;
use App\Models\PageAuth;
use App\Models\PageHome;
use App\Models\PageAbout;
use App\Models\PageRefund;
use App\Models\PageContact;
use App\Models\PagePrivacy;
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

        $page_auth = [
            ['id' => 1],
        ];
        include('data/data.php');

        PageAuth::insert($page_auth);
        PageHome::insert($page_home);
        
        PageAbout::insert($page_about);
        PageContact::insert($page_contact);
        PageTnc::insert($page_tnc);
        PagePrivacy::insert($page_privacy);
        PageRefund::insert($page_refund);
    }
}
