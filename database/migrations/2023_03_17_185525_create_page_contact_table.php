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
        Schema::create('page_contact', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('banner')->default('dummy.png');
            $table->string('form_heading1')->default('dummy');
            $table->string('form_paragraph1')->default('dummy');
            $table->longText('map_embad_url')->nullable();
            $table->string('working_hour')->default('dummy');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_contact');
    }
};
