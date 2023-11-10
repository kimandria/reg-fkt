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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('num');
            $table->unsignedBigInteger('fokontany_id');
            $table->unsignedBigInteger('first_head_id');
            $table->unsignedBigInteger('second_head_id');

            $table->foreign('fokontany_id')->references('id')->on('fokontanies')->onDelete('cascade');
            $table->foreign('first_head_id')->references('id')->on('citizens')->onDelete('cascade');
            $table->foreign('second_head_id')->references('id')->on('citizens')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
