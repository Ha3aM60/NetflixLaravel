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
        Schema::create('genre_serials', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('genreId');
            $table->foreign('genreId')->references('id')->on('genres');
            $table->unsignedBigInteger('serialsId');
            $table->foreign('serialsId')->references('id')->on('serials');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('genre_serials');
    }
};
