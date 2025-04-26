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
      // database/migrations/2025_04_26_000001_create_customer_types_table.php
Schema::create('customer_types', function (Blueprint $table) {
    $table->id('customer_type_id');
    $table->string('customer_type_description');
    $table->timestamps();
});

        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_types');
    }
};
