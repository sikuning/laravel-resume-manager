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
        Schema::create('banner_settings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('sub_title');
            $table->string('image')->nullable();
            $table->timestamps();
        });

        DB::table('banner_settings')->insert([
            'title' => 'Lorem ipsum dolor, sit amet consectetur adipisicing.',
            'sub_title' => 'Lorem ipsum dolor, sit amet consectetur adipisicing.',
            'image' => 'banner.png',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banner_settings');
    }
};
