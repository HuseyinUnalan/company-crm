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
        Schema::create('offer_details', function (Blueprint $table) {
            $table->id();
            $table->integer('sales_id');
            $table->integer('user_id');
            $table->integer('customer_id');
            $table->integer('product_id');
            $table->string('quantity');
            $table->string('kdv');
            $table->string('discount');
            $table->string('amount');
            $table->string('unit_price');
            $table->string('total');
            $table->string('total_price');
            $table->string('height');
            $table->string('quantity_weight');
            $table->string('withholding_status');
            $table->string('date');
            $table->string('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offer_details');
    }
};
