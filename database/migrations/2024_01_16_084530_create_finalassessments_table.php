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
        Schema::create('finalassessments', function (Blueprint $table) {
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->bigInteger('phone');
            $table->string('gender');
            $table->string('language');
            $table->string('image');
            $table->string('user');
            $table->string('auth');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finalassessments');
    }
};
