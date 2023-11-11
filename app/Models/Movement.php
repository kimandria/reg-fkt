<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    use HasFactory;
    protected $fillable = [
        'book_id',
        'from_fkt_id',
        'to_fkt_id',
        'pending',
        'departure_date',
        'arrival_date',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function fromFokontany()
    {
        return $this->belongsTo(Fokontany::class, 'from_fkt_id');
    }

    public function toFokontany()
    {
        return $this->belongsTo(Fokontany::class, 'to_fkt_id');
    }
}
