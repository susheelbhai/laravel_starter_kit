<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // relations
            $table->foreignId('seller_id')
                ->constrained('sellers')
                ->cascadeOnDelete();

            $table->foreignId('product_category_id')
                ->constrained('product_categories')
                ->restrictOnDelete();

            // basic info
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('sku')->nullable()->unique();

            // descriptions
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();

            // pricing
            $table->decimal('price', 10, 2);
            $table->decimal('mrp', 10, 2)->nullable();

            // inventory
            $table->integer('stock')->default(0);
            $table->boolean('manage_stock')->default(true);

            // media
            $table->string('thumbnail')->nullable();
            $table->string('gallery')->nullable(); // comma separated or JSON later

            // status & flags
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);

            // seo
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            // audit
            $table->foreignId('created_by_admin_id')
                ->nullable()
                ->constrained('admins')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
