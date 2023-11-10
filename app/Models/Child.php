<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;
    protected $fillable = [
        'book_id',
        'citizen_id',
    ];
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function child()
    {
        return $this->belongsTo(Citizens::class, 'citizen_id');

}
}
