<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('app_name')->nullable();
            $table->string('favicon')->nullable();
            $table->string('dark_logo')->nullable();
            $table->string('light_logo')->nullable();
            $table->string('title')->nullable();
            $table->string('address')->nullable();
            $table->string('detailed_address')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('short_description')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('twitter')->nullable();
            $table->string('google_map')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('admin_theme')->nullable();
            $table->string('user_theme')->nullable();
            $table->string('partner_theme')->nullable();
            $table->string('color1')->nullable();
            $table->string('color2')->nullable();
            $table->string('color3')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
};
