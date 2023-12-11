<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchReportContributionAttachment extends Model
{
    use HasFactory;
    protected $fillable = ['branch_report_contribution_id','file_name','file_path','file_size','file_type'];

    public function branchReportContribution()
    {
        return $this->belongsTo(BranchReportContribution::class);
    }
}
