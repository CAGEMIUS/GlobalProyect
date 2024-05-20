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
        Schema::create('product_pays', function (Blueprint $table) {
            $table->id();
            $table->string('nameProduct');
            $table->integer('quantity');
            $table->float('amount', 10, 2);
            $table->string('payment_id'); 
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_pays');
    }
};
