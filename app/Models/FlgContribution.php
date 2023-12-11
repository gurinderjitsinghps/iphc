<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlgContribution extends Model
{
    use HasFactory;

    protected $fillable = [
        'front_user_id',
        'payment_reference',
        'amount', 
    ];
    public function user()
    {
        return $this->belongsTo(FrontUser::class);
    }
}
