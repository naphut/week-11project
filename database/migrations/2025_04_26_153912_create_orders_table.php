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
      // database/migrations/2025_04_26_000003_create_orders_table.php
Schema::create('orders', function (Blueprint $table) {
    $table->string('order_id')->primary();
    $table->foreignId('product_id')->constrained('products', 'product_id');
    $table->foreignId('customer_type_id')->constrained('customer_types', 'customer_type_id');
    $table->foreignId('payment_type_id')->constrained('payment_types', 'payment_type_id');
    $table->integer('order_quantity');
    $table->dateTime('order_date_time');
    $table->string('order_status');
    $table->timestamps();
});
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
