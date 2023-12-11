<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable =[
        'firstname',
        'lastname',
        'amount',
        'email',
        'phonecode',
        'phone',
        'receive_donation_receipt',
        'recurring',
    ];
}
