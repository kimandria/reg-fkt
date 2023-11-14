<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citizens extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'birth_date',
        'birth_place',
        'father',
        'mother',
        'phone_num',
        'email',
        'nic_num',
        'nic_date',
        'nic_place',
        'job',
        'landlord',
    ];

    public function fokontany()

    {

        return $this->hasMany(Fokontany::class, 'fokontany_id');

    }


    public function firstHead()

    {

        return $this->hasMany(Citizen::class, 'first_head_id');

    }


    public function secondHead()

    {

        return $this->hasMany(Citizen::class, 'second_head_id');

    }

}
//     public function fokontanies()
// {
//     return $this->belongsTo(Fokontany::class);
// }
