<?php

namespace Database\Seeders;

use App\Models\PageHome;
use App\Models\PageAbout;
use App\Models\PageContact;
use App\Models\PagePrivacy;
use App\Models\PageRefund;
use App\Models\PageTnc;
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

      include('data/data.php');
       

        PageHome::create(['id'=>1]);
        PageAbout::create(['id'=>1]);
        
        PageContact::create([
            'id'=>1,
            'banner' => 'dummy.png',
            'form_heading1' => 'Lets talk about all things!',
            'form_paragraph1' => 'Write to us or give us a call. We will reply to you as soon as possible. But yes, it can take up to 24 hours.',
            'map_embad_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14017.914109416573!2d77.34703302383423!3d28.555389930658254!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce5ccaf6a0617%3A0x59318c70194d0a95!2sCANARA%20BANK%20-%20NOIDA%20SECTOR%2045!5e0!3m2!1sen!2sin!4v1679114987600!5m2!1sen!2sin',
            'working_hour' => 'We are open from 9am — 5pm business days.',
        ]);
        PageTnc::insert($page_tnc);
        PagePrivacy::insert($page_privacy);
        PageRefund::insert($page_refund);
    }
}
