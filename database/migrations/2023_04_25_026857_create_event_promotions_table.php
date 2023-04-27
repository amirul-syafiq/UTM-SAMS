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
        Schema::create('event_promotions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("promotion_description");
            $table->date('promotion_start_date');
            $table->date('promotion_end_date');
            $table->integer('participant_limit');
            $table->string('ecertificate_s3_key')->nullable();
            $table->foreignId('event_id')->constrained('events');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_promotions');
    }
};
