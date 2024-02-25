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
        Schema::create('actor_serials', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('serialId');
            $table->foreign('serialId')->references('id')->on('serials');
            $table->unsignedBigInteger('actorId');
            $table->foreign('actorId')->references('id')->on('actors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actor_serials');
    }
};
