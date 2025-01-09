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
        Schema::create('admin_badges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->string('badge_name', 100);
            $table->string('badge_picture', 100);
            $table->string('badge_description', 100);
            $table->string('badge_requirements', 100);
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
        Schema::dropIfExists('admin_badges');
    }
};
