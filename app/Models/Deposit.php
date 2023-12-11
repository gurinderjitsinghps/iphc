<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'type_id',
        'region_id',
        'branch_id',
        'amount',
        'summary_amount',
        'deposit_to',
        'request_for_approval_id',
        'date',
        'justification',
        'is_approved'          
    ];
    public function attachments()
    {
        return $this->hasMany(WithdrawalAttachment::class);
    }

}
