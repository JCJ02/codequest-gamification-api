<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminAuditTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admin_audit', function (Blueprint $table) {
            $table->id('audit_id');
            $table->unsignedBigInteger('admin_id')->nullable(); 
            $table->string('action_event', 50); 
            $table->string('description', 255); 
            $table->dateTime('event_date'); 
            $table->timestamps(); 
            $table->softDeletes();

            $table->foreign('admin_id')->references('id')->on('admin')->onDelete('set null')->onUpdate('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_audit');
    }
}
