<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BursaryAcademic extends Model
{
    use HasFactory;

    protected $fillable = [
        'bursary_id',
        'program_name',
        'institution_name',
        'student_number',
        'study_year', 
        'tution_costs',
        'meal_costs',
        'resident_costs',
        'material_costs',
        'online_study_material',
        'previously_awarded_financial_assist',
        'financial_assist_discontinued',
        'current_school_institute',
        'school_institute_program_of_study',
        'school_institute_study_year', 
        'current_gpa', 
    ];
}
