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
        Schema::create('cancelled_sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('original_schedule_id');
            $table->string('lesson_id');
            $table->string('tutor_id');
            $table->string('student_id');
            $table->date('booking_date');
            $table->float('morning_session_hours', 3, 1)->nullable();
            $table->string('morning_session_time')->nullable();
            $table->float('afternoon_session_hours', 3, 1)->nullable();
            $table->string('afternoon_session_time')->nullable();
            $table->float('total_session_duration', 3, 1);
            $table->integer('session_number');
            $table->enum('booking_method', ['one_day', 'multiple_sessions']);
            $table->timestamp('cancelled_at')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cancelled_sessions');
    }
};
