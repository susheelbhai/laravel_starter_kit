<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('page_home', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('banner_heading')->nullable();
            $table->longText('banner_description')->nullable();
            $table->string('why_us_heading')->nullable();
            $table->longText('why_us_description')->nullable();
            $table->string('about_heading')->nullable();
            $table->longText('about_description')->nullable();
            $table->string('why_us')->default('1');
            $table->string('testimonials')->default('1');
            $table->string('video')->default('1');
            $table->string('blogs')->default('1');
            $table->string('listings')->default('1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_home');
    }
};
