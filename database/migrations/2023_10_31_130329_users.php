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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('user_slug');
            $table->string('image')->nullable();
            $table->string('designation');
            $table->string('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('email');
            $table->string('password');
            $table->string('phone');
            $table->string('city')->nullable();
            $table->integer('pincode')->nullable();
            $table->string('state')->nullable();
            $table->string('country');
            $table->string('layout')->default('style1');
            $table->boolean('status')->default('1');
            $table->boolean('show_gender')->default('1');
            $table->boolean('show_dob')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
