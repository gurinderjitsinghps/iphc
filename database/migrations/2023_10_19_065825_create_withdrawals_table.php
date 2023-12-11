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
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('region_id');
            $table->unsignedBigInteger('branch_id');
            $table->decimal('amount', 10, 2); 
            $table->string('name');
            $table->string('withdraw_to')->nullable();
            $table->unsignedBigInteger('request_for_approval_id');
            $table->date('service_date');
            $table->text('justification');
            $table->boolean('is_approved')->default(false);           
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdrawals');
    }
};
