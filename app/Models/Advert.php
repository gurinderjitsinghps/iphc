<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'details', 
        'seller', 
        'email', 
        'phone',
        'cost',
        'url',   
        'start_date',
        'end_date',
    ];

    public function attachments()
    {
        return $this->hasMany(AdvertAttachment::class);
    }
   
}
