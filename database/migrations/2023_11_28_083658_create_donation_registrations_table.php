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
        Schema::create('donation_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->unsignedBigInteger('region_id');
            $table->unsignedBigInteger('branch_id');
            $table->string('phonecode')->nullable();
            $table->string('phone');
            $table->boolean('metric')->default(false);
            $table->string('grade')->nullable();
            $table->string('school');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donation_registrations');
    }
};
