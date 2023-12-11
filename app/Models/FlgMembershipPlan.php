<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlgMembershipPlan extends Model
{
    use HasFactory;
    protected $fillable = [
        'month',
        'amount_min',
        'amount_max',
        'team_category_id'
    ];
    
    public function team_category()
    {
        return $this->belongsTo(TeamCategory::class);
    }
}
