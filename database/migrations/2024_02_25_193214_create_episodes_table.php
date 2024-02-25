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
        Schema::create('episodes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('seasonId');
            $table->foreign('seasonId')->references('id')->on('seasons');
            $table->string('path');
            $table->string('description');
            $table->string('title');
            $table->string('time');
        });
        Schema::table('actors', function (Blueprint $table) {
            $table->renameColumn('direction', 'description');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('episodes');
    }
};
