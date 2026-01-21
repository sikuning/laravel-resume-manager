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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('page_title');
            $table->string('page_slug');
            $table->longText('description');
            $table->boolean('status')->default('1');
            $table->integer('show_in_header')->nullable();
            $table->integer('show_in_footer')->nullable();
            $table->timestamps();
        });

        DB::table('pages')->insert([
            [
                'page_title' => 'Privacy',
                'page_slug' => 'privacy',
                'description' => 'Pellentesque vel vestibulum nunc. Sed eu ante nunc. Proin non vestibulum ipsum. Curabitur quis maximus lorem, eu elementum erat. Aliquam erat volutpat. Integer nec bibendum ex. Nulla nec maximus nisl,',
                'show_in_header' => '0',
                'show_in_footer' => '1',
            ],[
                'page_title' => 'Terms & Conditions',
                'page_slug' => 'terms-conditions',
                'description' => 'Pellentesque vel vestibulum nunc. Sed eu ante nunc. Proin non vestibulum ipsum. Curabitur quis maximus lorem, eu elementum erat. Aliquam erat volutpat. Integer nec bibendum ex. Nulla nec maximus nisl,',
                'show_in_header' => '0',
                'show_in_footer' => '1',
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
