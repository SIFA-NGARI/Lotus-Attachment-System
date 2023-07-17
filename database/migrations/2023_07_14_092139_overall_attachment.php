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
        Schema::create('overall_attachment', function (Blueprint $table) {
            $table->id('id');
            $table->integer('supervisor_id');
            $table->string('type');
            $table->datetime('deadline');
            $table->integer('open');
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
