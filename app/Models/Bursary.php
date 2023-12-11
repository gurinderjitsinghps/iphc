<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bursary extends Model
{
    use HasFactory;

    protected $fillable =[
        'bursary_recommend_id',
        'front_user_id',
        'name',
        'id_number',
        'gender',
        'location',
        'lat',
        'long',
        'region_id',
        'branch_id',
        'phonecode',
        'phone',
        'email',
        'dob', 
        'signature', 
    ];
}
