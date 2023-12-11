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
        Schema::create('flg_membership_plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_category_id');
            $table->integer('month');
            $table->decimal('amount_min', 10, 2); 
            $table->decimal('amount_max', 10, 2)->default(0); 
            $table->timestamps();
    
            $table->foreign('team_category_id')->references('id')->on('team_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flg_membership_plans');
    }
};
