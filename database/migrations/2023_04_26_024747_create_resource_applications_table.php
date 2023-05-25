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
            $table->string('application_purpose');
            $table->date('apply_date');
            $table->date('review_date')->nullable();
            $table->date('rent_start_date');
            $table->date('rent_end_date');
            $table->foreignId('applicant_id')->constrained('clubs');
            $table->string ('application_status',5)->default('AP01');
            $table->foreign('application_status')->references('status_code')->on('rf_statuses') ;
            $table->timestamps();

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
