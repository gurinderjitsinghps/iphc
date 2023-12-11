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
        Schema::create('business_funding_categories', function (Blueprint $table) {
            $table->id();
            $table->string('registered_number'); 
            $table->string('name'); 
            $table->string('size'); 
            $table->string('interests'); 
            $table->string('inclusions'); 
            $table->string('other'); 
            $table->string('image')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_funding_categories');
    }
};
