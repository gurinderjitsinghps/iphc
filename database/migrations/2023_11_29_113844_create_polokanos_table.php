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
        Schema::create('polokanos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('front_user_id');
            $table->unsignedBigInteger('region_id');
            $table->unsignedBigInteger('branch_id');
            $table->enum('plan',['individual','family'])->default('individual');
            $table->string('title');
            $table->string('firstname');
            $table->string('lastname');
            $table->boolean('rsa_id')->default(false);
            $table->string('id_number');
            $table->date('dob');
            $table->string('phonecode')->nullable();
            $table->string('phone');
            $table->string('email');
            $table->string('address');
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->string('funeral_benefits');
            $table->string('cash_plan');
            $table->string('main_member_id_attachment');
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('polokanos');
    }
};
