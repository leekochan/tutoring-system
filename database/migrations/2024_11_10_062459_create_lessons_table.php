<?php

use App\Models\Tutor;
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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->string('lesson_tutor');
            $table->string('title');
            $table->text('description');
            $table->string('price');
            $table->string('duration');
            $table->string('topics');
            $table->timestamps(); // Keep only one timestamps() call

            $table->foreign('lesson_tutor')
                ->references('tutor_id')
                ->on('tutors')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
