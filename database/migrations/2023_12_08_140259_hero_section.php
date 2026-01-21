<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hero_section', function (Blueprint $table) {
            $table->id();
            $table->string('pre_title')->nullable();
            $table->string('title')->nullable();
            $table->string('sub_title')->nullable();
            $table->string('show_contact_btn')->nullable();
            $table->string('show_portfolio_btn')->nullable();
            $table->string('image')->nullable();
            $table->integer('user');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_section');
    }
};
