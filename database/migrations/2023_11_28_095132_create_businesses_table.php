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
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->string('cover_photo');
            $table->string('name');
            $table->string('type');
            $table->string('phonecode')->nullable();
            $table->string('phone');
            $table->string('email');
            $table->string('address');
            $table->string('services_offered');
            $table->string('owner_firstname');
            $table->string('owner_lastname');
            $table->string('owner_address');
            $table->string('owner_lat')->nullable();
            $table->string('owner_long')->nullable();
            $table->unsignedBigInteger('region_id');
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('category_id');
            $table->string('ssn_tin');
            $table->decimal('ownership_percentage', 10, 2)->nullable();
            $table->date('start_date');
            $table->string('tax_information');
            $table->string('website');
            $table->string('payment_information');
            $table->text('insurance_information');
            $table->text('terms_conditions');
            $table->text('privacy_policy');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};
