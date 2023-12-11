<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bursary_academics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bursary_id');
            $table->string('program_name');
            $table->string('institution_name');
            $table->string('student_number');
            $table->date('study_year'); 
            $table->decimal('tution_costs', 10, 2); 
            $table->decimal('meal_costs', 10, 2); 
            $table->decimal('resident_costs', 10, 2); 
            $table->decimal('material_costs', 10, 2); 
            $table->text('online_study_material');
            $table->text('previously_awarded_financial_assist');
            $table->text('financial_assist_discontinued');
            $table->string('current_school_institute');
            $table->string('school_institute_program_of_study');
            $table->date('school_institute_study_year'); 
            $table->decimal('current_gpa',10, 2); 
            $table->timestamps();
            $table->foreign('bursary_id')->references('id')->on('bursaries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bursary_academics');
    }
};
