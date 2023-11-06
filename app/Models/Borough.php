<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\District;

class Borough extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'district_id'
    ];

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function fokontanies()
    {
        return $this->hasMany(Fokontany::class, 'bourough_id');
    }
}
