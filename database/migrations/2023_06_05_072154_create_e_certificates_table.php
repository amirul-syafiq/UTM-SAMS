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
        Schema::create('e_certificates', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('ecertificate_name');
            $table->string('ecertificate_description')->nullable();
            $table->string('ecertificate_status',5)->default('EC01');
            $table->foreign('ecertificate_status')->references('status_code')->on('rf_statuses');
            $table->json('ecertificate_attribute_key_value')->nullable();
            $table->foreignId('event_advertisement_id')->constrained('event_advertisements')->nullable();
            $table->string('ecertificate_s3_key');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('e_certificates');
    }
};
