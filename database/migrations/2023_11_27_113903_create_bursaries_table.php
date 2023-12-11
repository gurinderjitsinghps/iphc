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
        Schema::create('bursaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bursary_recommend_id');
            $table->unsignedBigInteger('front_user_id');
            $table->string('name');
            $table->string('id_number');
            $table->enum('gender',['male','female']);
            $table->string('location');
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->unsignedBigInteger('region_id');
            $table->unsignedBigInteger('branch_id');
            $table->string('phonecode')->nullable();
            $table->string('phone');
            $table->string('email');
            $table->date('dob'); 
            $table->string('signature')->nullable(); 
            $table->timestamps();
            $table->foreign('front_user_id')->references('id')->on('front_users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bursaries');
    }
};
