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
        Schema::create('supervisor_allocations', function (Blueprint $table) {
            $table->id('allocation_id');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('supervisor_id');

            $table->foreign('student_id')->references('id')->on('users');
            $table->foreign('supervisor_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
