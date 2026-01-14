<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(SettingSeeder::class);
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(Slider1Seeder::class);
        $this->call(PageSeeder::class);
        $this->call(ImportantLinkSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(PartnerSeeder::class);
        $this->call(SellerSeeder::class);
        $this->call(UserQueryStatusSeeder::class);
        $this->call(UserQuerySeeder::class); 
        $this->call(BlogSeeder::class); 
        $this->call(BlogViewSeeder::class); 
        $this->call(BlogCommentSeeder::class); 
        $this->call(ServiceSeeder::class); 
        $this->call(PortfolioSeeder::class);
        $this->call(FaqCategorySeeder::class);
        $this->call(FaqSeeder::class);
        $this->call(TeamSeeder::class);
        $this->call(TestimonialSeeder::class);
        $this->call(ProductCategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ProductEnquirySeeder::class);
        $this->call(ProjectSeeder::class);
        $this->call(MediaSeeder::class);
    }
}
