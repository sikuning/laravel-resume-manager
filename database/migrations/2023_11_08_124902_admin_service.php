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
        Schema::create('admin_service', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image')->nullable();
            $table->text('description');
            $table->boolean('status')->default('1');
            $table->timestamps();
        });

        DB::table('admin_service')->insert([
            [
                'title' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit',
                'image' => 'service1.png',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt molestias molestiae provident perspiciatis fugiat pariatur?',
            ],
            [
                'title' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit',
                'image' => 'service2.png',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt molestias molestiae provident perspiciatis fugiat pariatur?',
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_service');
    }
};
