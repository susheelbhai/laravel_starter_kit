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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('created_by')->nullable()->references('id')->on('admins');
            $table->string('title');
            $table->string('slug')->nullable();
            $table->string('category')->nullable();
            $table->string('display_img')->default('dummy.png');
            $table->string('tags')->nullable();
            $table->longText('short_description')->nullable();
            $table->longText('long_description1')->nullable();
            $table->longText('long_description2')->nullable();
            $table->longText('long_description3')->nullable();
            $table->boolean('is_active')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
