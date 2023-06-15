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
        Schema::create('event_advertisements', function (Blueprint $table) {
            $table->id();
            $table->string("advertisement_title");
            $table->text("advertisement_description");
            $table->date('advertisement_start_date');
            $table->date('advertisement_end_date');
            $table->integer('participant_limit');
            $table->string('additional_information_key')->nullable();
            $table->foreignId('event_id')->constrained('events');
            $table->string('advertisement_status',5)->default('EV01');
            $table->foreign('advertisement_status')->references('status_code')->on('rf_statuses');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_advertisements');
    }
};
