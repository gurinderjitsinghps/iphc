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
        Schema::create('bursary_recommends', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('location');
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->date('closing_date'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bursary_recommends');
    }
};
