<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchReportContribution extends Model
{
    use HasFactory;
    protected $fillable = [
        'branch_report_id',
        'user_id',
        'contribution_id',
        'amount',
        'justification',     
    ];
    public function attachments()
    {
        return $this->hasMany(BranchReportContributionAttachment::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class,'contribution_id');
    }
    public function branchReport()
    {
        return $this->belongsTo(BranchReport::class);
    }
}
