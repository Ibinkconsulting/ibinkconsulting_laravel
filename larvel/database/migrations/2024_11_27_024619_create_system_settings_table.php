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
        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
            $table->string('title', 250)->nullable();
            $table->string('logo', 250)->nullable();
            $table->string('white_logo', 250)->nullable();
            $table->string('favicon', 250)->nullable();
            $table->string('phone_code', 25)->nullable();
            $table->string('phone_number', 25)->nullable();
            $table->string('email', 250)->nullable();
            $table->text('footer_text', 250)->nullable();
            $table->string('address', 250)->nullable();
            $table->text('office_time', 250)->nullable();
            $table->string('copyright', 500)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_settings');
    }
};
