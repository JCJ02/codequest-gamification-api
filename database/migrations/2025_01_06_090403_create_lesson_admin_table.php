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
        Schema::create('lesson_admin', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id')->nullable(); 
            $table->foreign('admin_id')->references('id')->on('admin')->onDelete('set null');
            $table->string('lesson_vid')->unique();
            $table->string('lesson_title');
            $table->text('lesson_description');
            $table->decimal('lesson_prize', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_admin');
    }
};
