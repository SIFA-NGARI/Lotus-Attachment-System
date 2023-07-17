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
        Schema::create('logbook', function (Blueprint $table) {
            $table->id('id');
            $table->integer('attachment_id');
            $table->string('date');
            $table->longText('tasks');
            $table->longText('objectives');
            $table->longText('lessons');
            $table->longText('comments');
            $table->integer('seen');
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
