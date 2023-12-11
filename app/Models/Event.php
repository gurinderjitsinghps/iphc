<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'region_id',
        'branch_id',
        'title',
        'description',
        'approx_attending',
        'venue',
        'host_name',
        'email',
        'event_purpose',
        'is_approved',
        'type',
        'cover_photo',
        'budget_price',
        'start_date',
        'end_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
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
