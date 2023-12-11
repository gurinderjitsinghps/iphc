<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawalAttachment extends Model
{
    use HasFactory;
    protected $fillable = ['withdrawal_id','file_name','file_path','file_size','file_type'];

    public function withdrawal()
    {
        return $this->belongsTo(Withdrawal::class);
    }
}
