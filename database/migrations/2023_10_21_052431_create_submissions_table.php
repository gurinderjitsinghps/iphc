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
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('submissionable_id');
            $table->unsignedBigInteger('region_id');
            $table->unsignedBigInteger('branch_id');
            $table->string('submissionable_type');
            $table->enum('type',['Event','Withdrawal','Polokano','FigEmpire','bursery']);
            $table->enum('status_level',['branch','regional','national'])->default('branch');
            $table->enum('status',['pending','accepted','rejected','final'])->default('pending');
            $table->unsignedBigInteger('status_update_by_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
