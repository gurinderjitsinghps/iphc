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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('region_id');
            $table->unsignedBigInteger('branch_id');
            $table->string('title');
            $table->text('description');
            $table->unsignedInteger('approx_attending');
            $table->string('venue');
            $table->string('host_name');
            $table->string('email');
            $table->string('event_purpose');
            $table->boolean('is_approved')->default(false);
            $table->enum('type',['branch','regional','national']);
            $table->string('cover_photo')->nullable();
            $table->decimal('budget_price', 10, 2); 
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
