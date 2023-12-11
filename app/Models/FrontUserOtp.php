<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrontUserOtp extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'phonecode',
        'phone',
        'otp',
    ];
}
