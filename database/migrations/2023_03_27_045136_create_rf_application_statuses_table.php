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
        Schema::create('rf_application_statuses', function (Blueprint $table) {
            $table->timestamps();
            $table->string('application_status');
            $table->string('application_status_description');
            $table->timestamp('deleted_at')->nullable();
            $table->string('status_code');
            $table->primary('status_code');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('r_f__application__statuses');
    }
};
