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
       // database/migrations/2025_04_26_000000_create_products_table.php
Schema::create('products', function (Blueprint $table) {
    $table->id('product_id');
    $table->string('product_name');
    $table->decimal('product_price', 10, 2);
    $table->integer('product_quantity_stock');
    $table->string('product_status');
    $table->text('product_description')->nullable();
    $table->timestamps();
});
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
