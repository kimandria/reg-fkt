<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    use HasFactory;
    protected $fillable = [
        'num',
        'fokontany_id',
        'sector',
        'numcarnet',
        'address',
        'phonenum',
        'email',
        'modified_at',
        'origin_fokontany',
        'arrival_date',
        'departure_date'
    ];

    public function fokontany()
    {
        return $this->belongsTo(Fokontany::class, 'fokontany_id');
    }
}
