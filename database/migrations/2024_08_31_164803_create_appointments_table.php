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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('veterinarian_id')->constrained('veterinarians')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('pet_id')->constrained('pets')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('schedule_id')->constrained('schedules')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('status')->default('pending')->nullable();
            $table->text('purpose_of_appointment');
            $table->string('session_of_appointment');
            $table->dateTime('appointment_time');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
