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
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string("tag_name");
            $table->string("tag_description");
            $table->timestamps();

        });

        // pivot table
        Schema::create('event_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId("event_promotion_id")->constrained("event_promotions")->onDelete("cascade");
            $table->foreignId("tag_id")->constrained("tags")->onDelete("cascade");
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags');
        Schema::dropIfExists('event_tags');
    }
};
