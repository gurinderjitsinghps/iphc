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
        Schema::create('polokano_beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('polokano_id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('id_number');
            $table->string('phonecode')->nullable();
            $table->string('phone');
            $table->timestamps();
            $table->foreign('polokano_id')->references('id')->on('polokanos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('polokano_beneficiaries');
    }
};
