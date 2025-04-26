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
        
// database/migrations/2025_04_26_000002_create_payment_types_table.php
Schema::create('payment_types', function (Blueprint $table) {
    $table->id('payment_type_id');
    $table->string('payment_type_description');
    $table->timestamps();
});
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_types');
    }
};
