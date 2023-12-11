<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BursaryRecommend extends Model
{
    use HasFactory;

    protected $fillable =[
        'title',
        'location',
        'lat',
        'long',
       'closing_date', 
    ];
    public function bursaries()
    {
        return $this->hasMany(Bursary::class);
    }
}
