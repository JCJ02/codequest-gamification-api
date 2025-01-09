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
        Schema::create('user_student_unlocked_level', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_student_id')->nullable();
            $table->unsignedBigInteger('admin_level_id')->nullable();
            $table->timestamp('unlocked_date');
            $table->timestamps();
            $table->softdeletes();

            $table->foreign('user_student_id')->references('id')->on('user_student')->onDelete('set null');
            $table->foreign('admin_level_id')->references('id')->on('admin_level')->onDelete('set null');});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_student_unlocked_level');
    }
};
