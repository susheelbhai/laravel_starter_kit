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
        $slider1 = array(
            array('id' => '1', 'created_at' => '2023-03-22 10:52:34', 'updated_at' => '2023-03-22 10:52:34', 'heading1' => 'Home Networks Housing Solution', 'heading2' => 'Rahne ka naya jugaad', 'paragraph1' => NULL, 'paragraph2' => NULL, 'btn_name' => 'Contact Now', 'btn_url' => NULL, 'btn_target' => '_blank', 'image1' => 'housing.png', 'image2' => NULL, 'is_active' => '1'),
            array('id' => '2', 'created_at' => '2023-03-22 10:54:27', 'updated_at' => '2023-03-22 10:55:04', 'heading1' => 'Home Networks Design Center', 'heading2' => 'We transform your house into home', 'paragraph1' => NULL, 'paragraph2' => NULL, 'btn_name' => 'Contact Now', 'btn_url' => NULL, 'btn_target' => '_blank', 'image1' => 'interior.png', 'image2' => NULL, 'is_active' => '1'),
            array('id' => '3', 'created_at' => '2023-03-22 10:56:31', 'updated_at' => '2023-03-22 10:56:45', 'heading1' => 'Home Networks Maintenance Service', 'heading2' => 'Your Most trust worthy helper at the lowest cost', 'paragraph1' => NULL, 'paragraph2' => NULL, 'btn_name' => 'Contact Now', 'btn_url' => NULL, 'btn_target' => '_blank', 'image1' => 'maintainence.png', 'image2' => NULL, 'is_active' => '1')
          );
        Slider1::insert($slider1);
    }
}
