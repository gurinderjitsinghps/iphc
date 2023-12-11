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
        Schema::create('branch_report_contributions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_report_id');
            $table->unsignedBigInteger('category_id');
            $table->text('justification');
            $table->decimal('amount', 10, 2); 
            $table->timestamps();

            $table->foreign('branch_report_id')->references('id')->on('branch_reports')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch_report_contributions');
    }
};
