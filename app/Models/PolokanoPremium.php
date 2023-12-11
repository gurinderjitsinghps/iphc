<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PolokanoPremium extends Model
{
    use HasFactory;
    protected $fillable = [
        'polokano_id',
        'firstname',
        'lastname',
        'type',
        'category',
        'number',
        'premium_monthly',
    ];
    public function polokano()
    {
        return $this->belongsTo(Polokano::class);
    }
}
