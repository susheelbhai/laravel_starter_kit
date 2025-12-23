<?php

namespace Database\Seeders;

use App\Models\ProductEnquiry;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductEnquirySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        include('data/data.php');
        if (isset($product_enquiries) && is_array($product_enquiries)) {
            ProductEnquiry::insert($product_enquiries);
        }
    }
}
