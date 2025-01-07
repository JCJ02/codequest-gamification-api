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
        Schema::create('user_student_audit', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_student_id')->nullable();
            $table->string('action_event', 50);
            $table->text('description');
            $table->dateTime('event_date');
            $table->timestamps();

            $table->foreign('user_student_id')->references('id')->on('user_student')->onDelete('set null');       });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_student_audit');
    }
};
