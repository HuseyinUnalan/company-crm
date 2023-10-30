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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('user_id');
            $table->string('photo')->nullable();
            $table->string('slug')->nullable();
            $table->string('type')->nullable();
            $table->string('unit_price')->nullable();
            $table->string('quantity_weight')->nullable();
            $table->string('height')->nullable();
            $table->string('kdv')->nullable();
            $table->string('entered_kdv')->nullable();
            $table->string('withholding_status')->nullable();
            $table->string('quantity')->default(1);
            $table->string('category')->nullable();
            $table->string('discount')->nullable();
            $table->string('entered_unit_price')->nullable();
            $table->string('general_discount_product')->default(0);
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
