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
            Schema::create('comments', function (Blueprint $table) {
                $table->id();
                $table->longtext('cmt');
                $table->unsignedBigInteger('id_user');
                $table->unsignedBigInteger('id_blog');
                $table->string('avatar_user');
                $table->string('name_user');
                $table->unsignedBigInteger('level')->default(0)->comment('0: comment cha');
                $table->timestamps();
                $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('id_blog')->references('id')->on('blogs')->onDelete('cascade');
                
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
