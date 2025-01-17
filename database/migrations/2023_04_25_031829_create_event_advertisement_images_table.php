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
        Schema::create('event_advertisement_images', function (Blueprint $table) {
            $table->id();
            $table->string("image_name");
            $table->string('image_description')->nullable();
            $table->foreignId('event_advertisement_id')->constrained('event_advertisements')->unique();
            $table->string('image_s3_key');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_advertisement_images');
    }
};
