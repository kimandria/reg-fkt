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
        Schema::create('registers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fokontany_id');
            $table->foreign('fokontany_id')->references('id')->on('fokontanies');
            $table->string('num');
            $table->string('sector');
            $table->string('numcarnet');
            $table->string('address');
            $table->string('phonenum');
            $table->string('email');
            $table->date('modified_at');
            $table->string('origin_fokontany');
            $table->date('arrival_date');
            $table->date('departure_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registers');
    }
};
