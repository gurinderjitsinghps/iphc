<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];
    
    public function membership_plans()
    {
        return $this->hasMany(FlgMembershipPlan::class);
    }
}
