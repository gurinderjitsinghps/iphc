<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'cover_photo',
        'name',
        'type',
        'phonecode',
        'phone',
        'email',
        'address',
        'services_offered',
        'owner_firstname',
        'owner_lastname',
        'owner_address',
        'owner_lat',
        'owner_long',
        'region_id',
        'branch_id',
        'ssn_tin',
        'ownership_percentage',
        'start_date',
        'tax_information',
        'website',
        'payment_information',
        'insurance_information',
        'terms_conditions',
        'privacy_policy',
        'category_id',
    ];
}
