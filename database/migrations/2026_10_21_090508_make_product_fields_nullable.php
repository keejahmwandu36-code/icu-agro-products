<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->text('full_description')->nullable()->change();
            $table->text('ingredients')->nullable()->change();
            $table->text('directions')->nullable()->change();
            $table->decimal('price', 10, 2)->nullable()->change();
            $table->integer('stock_quantity')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->text('full_description')->nullable(false)->change();
            $table->text('ingredients')->nullable(false)->change();
            $table->text('directions')->nullable(false)->change();
            $table->decimal('price', 10, 2)->nullable(false)->change();
        });
    }
};