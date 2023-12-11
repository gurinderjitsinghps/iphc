<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
        'dob', 
        'profile_image', 
        'gender',   
        'phonecode',
        'phone',
        'email',
        'address',
        'city',
        'state',
        'zipcode',
        'branch_id',
        'region_id',
        'is_blocked',
        'user_id',
        'user_type_id',
        'contribution_as',
    ];
    
}
