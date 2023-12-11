<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessFundingCategory extends Model
{
    use HasFactory;
    protected $fillable =[
        'registered_number' ,
        'name' ,
        'size' ,
        'interests' ,
        'inclusions' ,
        'other' ,
        'image' 
    ];
}
