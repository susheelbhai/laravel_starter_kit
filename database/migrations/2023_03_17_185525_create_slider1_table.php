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
        Schema::create('slider1', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('heading1')->nullable();
            $table->string('heading2')->nullable();
            $table->string('paragraph1')->nullable();
            $table->string('paragraph2')->nullable();
            $table->string('btn_name')->nullable();
            $table->string('btn_url')->nullable();
            $table->string('btn_target')->nullable();
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->boolean('is_active')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slider1');
    }
};
