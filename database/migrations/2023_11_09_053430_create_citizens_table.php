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
        Schema::create('citizens', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birth_date');
            $table->string('birth_place');
            $table->string('father');
            $table->string('mother');
            $table->string('phone_num');
            $table->string('email');
            $table->string('nic_num');
            $table->date('nic_date');
            $table->string('nic_place');
            $table->string('job');
            $table->string('landlord');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citizens');
    }
};
