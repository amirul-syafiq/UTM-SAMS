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
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('promotion_id')->constrained('event_promotions');
            $table->foreignId('user_id')->constrained('users');
            $table->date('register_date');
            $table->string('application_status')->default('AP01');
            $table->foreign('application_status')->references('status_code')->on('rf_statuses');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
