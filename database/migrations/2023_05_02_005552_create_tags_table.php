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
            $table->string("tag_name");
            $table->primary("tag_name");
            $table->string("tag_description")->nullable();
            $table->timestamps();

        });

        // pivot table
        Schema::create('event_advertisement_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId("event_advertisement_id")->constrained("event_advertisements")->onDelete("cascade");
            $table->string("tag_name");
            $table->foreign("tag_name")->references("tag_name")->on("tags")->onDelete("cascade");
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags');
        Schema::dropIfExists('event_advertisement_tags');
    }
};
