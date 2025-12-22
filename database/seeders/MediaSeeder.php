<?php

namespace Database\Seeders;

use App\Models\MediaExternal;
use App\Models\MediaInternal;
use Illuminate\Database\Seeder;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        include('data/data.php');
        Media::insert($media);
        MediaExternal::insert($media_external);
        MediaInternal::insert($media_internal);
    }
}
