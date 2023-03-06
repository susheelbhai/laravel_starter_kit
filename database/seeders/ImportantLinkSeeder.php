<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ImportantLink;

class ImportantLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array('name'=> 'Career', 'href'=> '#', 'image'=>'1.jpg'),
            array('name'=> 'Help & Support', 'href'=> '#', 'image'=>'2.jpg'),
            array('name'=> 'Privecy Policy', 'href'=> '#', 'image'=>'3.jpg'),
            array('name'=> 'Terms of uses', 'href'=> '#', 'image'=>'4.jpg'),
            array('name'=> 'Branches', 'href'=> 'https://www.incometaxindiaefiling.gov.in/', 'image'=>'5.jpg'),
        );

        ImportantLink::insert($data);
    }
}
