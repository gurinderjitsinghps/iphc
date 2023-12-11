<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchReport extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'region_id',
        'branch_id',
        'invoice_no',
        // 'branch_name',
        'brought_by',
        'grand_total',
        'justification',
        'billing_date',
        'date',    
    ];
    public function branchReportContributions()
    {
        return $this->hasMany(BranchReportContribution::class);
    }
}
