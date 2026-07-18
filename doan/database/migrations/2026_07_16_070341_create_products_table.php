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

            $table->unsignedBigInteger('id_user');

            $table->string('name');
            $table->decimal('price', 10, 2);

            $table->unsignedBigInteger('id_category');
            $table->unsignedBigInteger('id_brand');

            $table->tinyInteger('status')->default(0); // 0: New, 1: Sale
            $table->unsignedTinyInteger('sale')->default(0);// giam gia

            $table->string('company')->nullable();

            
            $table->string('image')->nullable();

            $table->longText('detail')->nullable();

            $table->timestamps();

            $table->foreign('id_user')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('id_category')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');

            $table->foreign('id_brand')
                ->references('id')
                ->on('brands')
                ->onDelete('cascade');
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
