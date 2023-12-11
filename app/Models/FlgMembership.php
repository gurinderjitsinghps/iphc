<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlgMembership extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'address',
        'lat',
        'long',
        'region_id',
        'branch_id',
        'postcode',
        'phone',
        'email',
       'employment_status',
        'profession',
        'team_category_id',
        'certificate_type',
        'membership_plan_id',
    ];
    public function user()
    {
        return $this->belongsTo(FrontUser::class);
    }
}
