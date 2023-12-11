<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonationRegistration extends Model
{
    use HasFactory;

    protected $fillable =[
        'firstname',
        'lastname',
        'region_id',
        'branch_id',
        'phonecode',
        'phone',
        'metric',
        'grade',
        'school',
    ];
}
