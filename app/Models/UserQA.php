<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserQA extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'question',
        'answer',
        'is_accepted',
    ];

    public function user()
    {
        return $this->belongsTo(FrontUser::class);
    }
}
