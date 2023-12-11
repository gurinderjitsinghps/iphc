<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepositAttachment extends Model
{
    use HasFactory;
    protected $fillable = ['deposit_id','file_name','file_path','file_size','file_type'];

    public function deposit()
    {
        return $this->belongsTo(Deposit::class);
    }
}
