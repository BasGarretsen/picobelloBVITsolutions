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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('activity_name');
            $table->string('location');
            $table->boolean('including_food');
            $table->string('omschrijving');
            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();
            $table->double('kosten');
            $table->integer('maximum_number_of_participants');
            $table->integer('minimum_number_of_participants');
            $table->string('image');
            $table->json('supplies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};