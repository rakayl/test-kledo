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
        Schema::create('approvals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('expense_id'); 
            $table->unsignedBigInteger('approver_id'); 
            $table->unsignedBigInteger('status_id'); 
            $table->foreign('expense_id')->references('id')->on('expenses'); 
            $table->foreign('approver_id')->references('id')->on('approvers'); 
            $table->foreign('status_id')->references('id')->on('statuses'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approvals');
    }
};
