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
            $table->double('price');
            $table->string('short_desc');
            $table->text('desc');
            $table->text('account');
            $table->foreignId('seller_id')->references('id')->on('users');
            $table->foreignId('buyer_id')->nullable()->references('id')->on('users');
            $table->foreignId('category_id')->references('id')->on('categories');
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
