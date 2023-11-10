<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Fokontany;
use App\Models\Citizens;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['num', 'fokontany_id', 'first_head_id', 'second_head_id'];

    public function fokontany()
    {
        return $this->belongsTo(Fokontany::class, 'fokontany_id');
    }

    public function firstHead()
    {
        return $this->belongsTo(Citizens::class, 'first_head_id');
    }

    public function secondHead()
    {
        return $this->belongsTo(Citizens::class, 'second_head_id');
    }
}
