<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessFunding extends Model
{
    use HasFactory;

    protected $fillable = [
        'front_user_id',
        'business_funding_category_id',
        'oragnization_name', 
        'oragnization_address', 
        'ssn_tin', 
        'oragnization_website', 
        'oragnization_president', 
        'phonecode',
        'phone',
        'email',
        'project_name', 
        'total_budget',
        'requested_amount',
        'total_budget_percentage',
        'grant_from', 
        'grant_to', 
        'area_served', 
        'recent_funder_name', 
        'recent_funder_amount',
        'recent_funder_date',
        'recent_funder_description',
    ];
}
