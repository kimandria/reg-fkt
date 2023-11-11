<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Borough;

class Fokontany extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'borough_id'
    ];

    public function borough()
    {
        return $this->belongsTo(Borough::class, 'borough_id');
    }
    public function books()
{
    return $this->hasMany(Book::class, 'fokontany_id');
}
    // Movement départs
public function movementsFrom()
{
    return $this->hasMany(Movement::class, 'from_fkt_id');
}

// Movement arrivées
public function movementsTo()
{
    return $this->hasMany(Movement::class, 'to_fkt_id');
}
}
