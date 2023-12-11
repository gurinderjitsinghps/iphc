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
        Schema::create('flg_memberships', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('address');
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->unsignedBigInteger('region_id');
            $table->unsignedBigInteger('branch_id');
            $table->string('postcode');
            $table->string('phone');
            $table->string('email');
            $table->enum('employment_status',['employed','unemployed','self_employed','business','student','pensioner']);
            $table->string('profession');
            $table->unsignedBigInteger('team_category_id');
            $table->string('certificate_type');
            $table->string('membership_plan_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flg_memberships');
    }
};
