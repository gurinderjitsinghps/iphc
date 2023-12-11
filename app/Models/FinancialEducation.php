<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialEducation extends Model
{
    use HasFactory;

    protected $fillable = [
        'front_user_id',
        'title',
        'description', 
        'video', 
    ];
    public function user()
    {
        return $this->belongsTo(FrontUser::class);
    }
}
