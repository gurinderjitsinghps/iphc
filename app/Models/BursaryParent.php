<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BursaryParent extends Model
{
    use HasFactory;

    protected $fillable =[
        'bursary_id',
        'name',
        'id_number',
        'gender',
        'membership_number',
        'type',
        'location',
        'lat',
        'long',
        'region_id',
        'branch_id',
        'phonecode',
        'occupation'
    ];
}
