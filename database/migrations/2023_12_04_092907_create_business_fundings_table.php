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
        Schema::create('business_fundings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('front_user_id');
            $table->unsignedBigInteger('business_funding_category_id');
            $table->string('oragnization_name'); 
            $table->string('oragnization_address'); 
            $table->string('ssn_tin'); 
            $table->string('oragnization_website'); 
            $table->string('oragnization_president'); 
            $table->string('phonecode')->nullable();
            $table->string('phone');
            $table->string('email');
            $table->string('project_name'); 
            $table->decimal('total_budget', 10, 2);
            $table->decimal('requested_amount', 10, 2);
            $table->decimal('total_budget_percentage', 5, 2);
            $table->date('grant_from'); 
            $table->date('grant_to'); 
            $table->string('area_served'); 
            $table->string('recent_funder_name'); 
            $table->decimal('recent_funder_amount', 10, 2);
            $table->date('recent_funder_date');
            $table->text('recent_funder_description');
            $table->timestamps();
            $table->foreign('front_user_id')->references('id')->on('front_users')->onDelete('cascade');    

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_fundings');
    }
};
