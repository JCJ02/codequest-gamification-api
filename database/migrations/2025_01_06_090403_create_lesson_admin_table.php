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
            $table->string('lesson_vid', 500);
            $table->string('lesson_title', 100);
            $table->text('lesson_description', 500);
            $table->string('lesson_prize', 100);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('admin_id')->references('id')->on('admin')->onDelete('set null');
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
