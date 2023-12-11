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
        Schema::create('flg_contributions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('front_user_id');
            $table->string('payment_reference');
            $table->decimal('amount', 10, 2); 
            $table->timestamps();
    
            $table->foreign('front_user_id')->references('id')->on('front_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flg_contributions');
    }
};
