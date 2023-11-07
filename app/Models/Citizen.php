<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Register;
class Citizen extends Model
{
    use HasFactory;
    protected $fillable = [
        'firstname',
        'lastname',
        'birthdate',
        'birthplace',
        'father',
        'mother',
        'cin_number',
        'nicDate',
        'nicPlace',
        'job',
        'landlord',
        'register_id' // ajoutez la clé étrangère ici
    ];

    public function register()
    {
        return $this->belongsTo(Register::class, 'register_id');
    }
}
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
            $table->unsignedInteger('num')->unique();
            $table->unsignedBigInteger('fokontany_id');
            $table->foreign('fokontany_id')->references('id')->on('fokontanies');
            $table->string('sector');
            $table->string('numcarnet');
            $table->string('address');
            $table->string('phonenum', 10); // Limite à 10 caractères
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
