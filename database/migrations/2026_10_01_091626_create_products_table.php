<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->enum('format', ['tea', 'capsules', 'both'])->default('both');
            $table->string('short_description');
            $table->text('full_description');
            $table->text('ingredients');
            $table->text('directions');
            $table->text('storage')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('currency', 3)->default('ZMW');
            $table->string('size');
            $table->enum('stock_status', ['in_stock', 'out_of_stock'])->default('in_stock');
            $table->integer('stock_quantity')->nullable();
            $table->string('image_main')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};