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
            $table->timestamps();
            $table->string("event_name");
            $table->string("event_description");
            $table->timestamp("event_start_date")->default(now());
            $table->timestamp("event_end_date")->nullable();
            $table->string("event_venue");
            $table->foreignId("event_type")->constrained("event_types")->onDelete("cascade");
            $table->string("event_status");
            $table->string("event_ref_no"); // reference no obtained from acad @ hep
            $table->foreignId("event_organizer")->constrained("users")->onDelete("cascade");
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
