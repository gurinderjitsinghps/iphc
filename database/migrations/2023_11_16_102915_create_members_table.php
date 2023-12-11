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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->string('email'); 
            $table->string('phonecode');
            $table->string('phone');
            $table->string('address'); 
            $table->string('city'); 
            $table->string('state'); 
            $table->string('zipcode'); 
            $table->string('branch_id'); 
            $table->string('region_id'); 
            $table->integer('user_id'); 
            $table->integer('user_type_id'); 
            $table->string('contribution_as'); 
            $table->string('profile_image'); 
            $table->boolean('is_blocked')->default(false); 
            $table->enum('gender',['male','female']);   
            $table->date('dob');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
