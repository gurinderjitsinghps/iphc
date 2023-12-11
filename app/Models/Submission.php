<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'submissionable_type',
        'submissionable_id',
        'status_update_by_id',
        'type',
        'status_level',
        'region_id',
        'branch_id',
        'status',
    ];
    public function submissionable()
    {
        return $this->morphTo();
    }
    public function questions()
    {
        return $this->hasMany(SubmissionQA::class);
    }
}
