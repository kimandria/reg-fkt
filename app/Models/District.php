<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Prefecture;

class District extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'prefecture_id'
    ];

    public function prefecture()
    {
        return $this->belongsTo(Prefecture::class, 'prefecture_id');
    }

    public function borough()
    {
        return $this->hasMany(Borough::class, 'district_id');
    }
}
