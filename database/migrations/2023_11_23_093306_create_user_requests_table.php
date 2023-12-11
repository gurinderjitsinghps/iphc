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
        $configRoles = config('roles');
        $configRoles = array_keys($configRoles);
        Schema::create('user_requests', function (Blueprint $table) use($configRoles) {
            $table->id();
            $table->unsignedBigInteger('user_id'); 
            $table->enum('role',$configRoles); 
            $table->enum('status',['pending','accepted','rejected'])->default('pending');   
            $table->unsignedBigInteger('status_update_by_id');   
            // $table->enum('status_update_by_role_level',['regional','national']);   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_requests');
    }
};
