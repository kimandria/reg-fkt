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
        Schema::create('fokontanies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('borough_id');
            $table->foreign('borough_id')->references('id')->on('boroughs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fokontanies');
    }
};
