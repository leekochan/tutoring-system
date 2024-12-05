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
            $table->time('booking_time');
            $table->float('session_duration', 3, 1);
            $table->integer('session_number');
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
