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
        Schema::create('preferences', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->boolean('status')->default('1');
            $table->integer('order');
            $table->timestamps();
        });

        DB::table('preferences')->insert([
            [
                'title' => 'Service',
                'status' => '0',
                'order' => '1',
            ],
            [
                'title' => 'Skill',
                'status' => '0',
                'order' => '2',
            ],[
                'title' => 'Experience',
                'status' => '0',
                'order' => '3',
            ],[
                'title' => 'Testimonial',
                'status' => '0',
                'order' => '4',
            ],[
                'title' => 'Porfolio',
                'status' => '0',
                'order' => '5',
            ],[
                'title' => 'Contact',
                'status' => '1',
                'order' => '6',
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preferences');
    }
};
