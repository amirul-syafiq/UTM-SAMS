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
        Schema::create('resource_applications', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('application_purpose');
            $table->date('apply_date');
            $table->date('review_date')->nullable();
            $table->date('rent_start_date');
            $table->date('rent_end_date');
            $table->foreignId('applicant_id')->constrained('clubs');
            $table->string ('application_status');
            $table->foreign('application_status')->references('status_code')->on('rf_application_statuses') ->default('A01');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resource_applications');
    }
};
