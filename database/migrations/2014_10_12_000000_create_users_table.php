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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone');
            $table->boolean('is_phone_verified')->default(false);
            $table->string('profile_image')->nullable();
            $table->string('bio')->nullable();
            $table->enum('role_level',['national','regional','branch'])->default('branch');
            $table->string('role')->default('user');
            $table->boolean('is_blocked')->default(false);
            $table->unsignedBigInteger('category_id')->nullable();
            $table->timestamp('expiry')->default(null);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
