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
        Schema::create('rates', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_blog');
            $table->unsignedBigInteger('id_user');
            $table->integer('rate');

            $table->foreign('id_blog')
                    ->references('id')
                    ->on('blogs')
                    ->onDelete('cascade');

            $table->foreign('id_user')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rates');
    }
};
