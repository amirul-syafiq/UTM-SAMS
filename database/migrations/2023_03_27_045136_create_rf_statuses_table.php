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
        Schema::create('rf_statuses', function (Blueprint $table) {

            $table->string('status_code');
            $table->primary('status_code');
            $table->string('status_name');
            $table->string('status_description');
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();



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
