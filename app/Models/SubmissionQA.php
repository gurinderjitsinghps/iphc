<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionQA extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'submission_id',
        'answered_by_id',
        'question',
        'answer',
        'is_accepted',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }
}
