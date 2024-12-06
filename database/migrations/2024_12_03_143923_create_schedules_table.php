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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('lesson_id');
            $table->foreign('lesson_id')->references('id')->on('lessons')->onDelete('cascade');
            $table->string('tutor_id');
            $table->foreign('tutor_id')->references('username')->on('users')->onDelete('cascade');
            $table->string('student_id');
            $table->foreign('student_id')->references('username')->on('users')->onDelete('cascade');

            $table->date('booking_date');

            // Add specific columns for morning and afternoon sessions
            $table->float('morning_session_hours', 3, 1)->nullable();
            $table->string('morning_session_time')->nullable();
            $table->float('afternoon_session_hours', 3, 1)->nullable();
            $table->string('afternoon_session_time')->nullable();

            $table->float('total_session_duration', 3, 1);
            $table->integer('session_number');
            $table->enum('booking_method', ['one_day', 'multiple_sessions']);
            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled'])->default('pending');

            $table->timestamps();

            $table->unique(['lesson_id', 'session_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
