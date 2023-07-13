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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->string('org_name');
            $table->string('branch');
            $table->string('address');
            $table->longText('description');
            $table->string('date');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->integer('hours');
            $table->longText('activities');
            $table->longText('skills');
            $table->integer('status');
            //0-pending, 1-Approved, 2- Rejected
            $table->string('type');

            $table->foreign('student_id')->references('id')->on('users');
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
