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
        Schema::create('admin_level', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->unsignedBigInteger('language_id')->nullable();
            $table->string('level_diffuculty', 100);
            $table->string('level_prize', 100);
            $table->string('level_task', 100);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('admin_id')->references('id')->on('admin')->onDelete('set null');
            $table->foreign('language_id')->references('id')->on('admin_language')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_level');
    }
};
