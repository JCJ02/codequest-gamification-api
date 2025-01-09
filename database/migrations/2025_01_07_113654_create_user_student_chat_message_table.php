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
        Schema::create('user_student_chat_message', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_student_id')->nullable();
            $table->unsignedBigInteger('recepient_id')->nullable();
            $table->timestamp('message_date');
            $table->string('message_content', 100);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_student_id')->references('id')->on('user_student')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_student_chat_message');
    }
};
