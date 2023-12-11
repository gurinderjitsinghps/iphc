<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvertAttachment extends Model
{
    use HasFactory;

    protected $fillable = ['advert_id','file_name','file_path','file_size','file_type'];

    public function advert()
    {
        return $this->belongsTo(Advert::class);
    }
}
