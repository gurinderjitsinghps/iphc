<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PolokanoDependent extends Model
{
    use HasFactory;

    protected $fillable = [
    'firstname',
    'lastname',
    'id_number',
    'relationship',
    'polokano_id',
    ];
    public function polokano()
    {
        return $this->belongsTo(Polokano::class);
    }
}
