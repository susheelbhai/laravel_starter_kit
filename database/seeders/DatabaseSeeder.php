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
        $this->call(PageSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(PartnerSeeder::class);
        $this->call(UserQueryStatusSeeder::class);
        $this->call(UserQuerySeeder::class); 
        $this->call(BlogSeeder::class); 
        $this->call(BlogCommentSeeder::class); 
        $this->call(ServiceSeeder::class); 
        $this->call(PortfolioSeeder::class);

        
    }
}
