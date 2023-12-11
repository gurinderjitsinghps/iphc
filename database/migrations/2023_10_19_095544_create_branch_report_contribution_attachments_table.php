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
        Schema::create('branch_report_contribution_attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_report_contribution_id');
            $table->string('file_name');
            $table->string('file_path');
            $table->string('file_size')->nullable();
            $table->string('file_type')->nullable();
            $table->timestamps();
            
            // $table->foreign('branch_report_contribution_id')->references('id')->on('branch_report_contributions')->onDelete('cascade');
            $table->foreign('branch_report_contribution_id', 'fk_attachment_branch_report_contribution_id')
            ->references('id')
            ->on('branch_report_contributions')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch_report_contribution_attachments');
    }
};
