<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'type_id',
        'region_id',
        'branch_id',
        'amount',
        'name',
        'request_for_approval_id',
        'service_date',
        'justification',
        'is_approved'          
    ];
    public function attachments()
    {
        return $this->hasMany(WithdrawalAttachment::class);
    }
    public function submissions()
    {
    return $this->morphMany(Submission::class, 'submissionable');
    }
    public function submission()
    {
    return $this->morphOne(Submission::class,'submissionable');
    }
}
