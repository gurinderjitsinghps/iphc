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
        Schema::create('bursary_parents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bursary_id');
            $table->string('name');
            $table->string('id_number');
            $table->enum('gender',['male','female']);
            $table->string('membership_number');
            $table->enum('type',['parent','guardian']);
            $table->string('location');
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->unsignedBigInteger('region_id');
            $table->unsignedBigInteger('branch_id');
            $table->string('phonecode')->nullable();
            $table->string('occupation');
            $table->timestamps();
            $table->foreign('bursary_id')->references('id')->on('bursaries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bursary_parents');
    }
};
