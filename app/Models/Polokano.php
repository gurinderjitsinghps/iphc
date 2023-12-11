<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Polokano extends Model
{
    use HasFactory;

    protected $fillable = [
        'plan',
        'region_id',
        'branch_id',
        'title',
        'firstname',
        'lastname',
        'rsa_id',
        'id_number',
        'dob',
        'phonecode',
        'phone',
        'email',
        'address',
        'lat',
        'long',
        'funeral_benefits',
        'cash_plan',
        'main_member_id_attachment',
        'front_user_id',
    ];
    public function dependents()
    {
        return $this->hasMany(PolokanoDependent::class);
    }
    public function spouses()
    {
        return $this->hasMany(PolokanoSpouse::class);
    }
    public function beneficiaries()
    {
        return $this->hasMany(PolokanoBeneficiary::class);
    }
    public function premium()
    {
        return $this->hasOne(PolokanoPremium::class);
    }
  
   
}
