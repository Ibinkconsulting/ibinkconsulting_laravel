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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->double('price');
            $table->string('location');
            $table->string('city')->nullable();
            $table->double('land_size')->nullable();
            $table->double('floor_size')->nullable();
            $table->double('bedrooms')->nullable();
            $table->double('bathrooms')->nullable();
            $table->integer('garages')->nullable();
            $table->integer('open_spaces')->nullable();
            $table->integer('establishment_year')->nullable();
            $table->text('description');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('ground_plan')->nullable();
            $table->string('first_plan')->nullable();
            $table->json('images')->nullable();
            $table->enum('apartment_type', ['rent', 'lease'])->default('rent');
            $table->enum('availability', ['available', 'unavailable'])->default('available');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
