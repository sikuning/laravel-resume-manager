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
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('com_name');
            $table->string('com_logo');
            $table->string('com_email');
            $table->string('com_phone');
            $table->string('address');
            $table->text('description');
            $table->string('footer_copyright');
            $table->integer('layouts');
            $table->timestamps();
        });

        DB::table('general_settings')->insert([
            'com_name' => 'Resume',
            'com_logo' => 'logo.png',
            'com_email' => 'admin@example.com',
            'com_phone' => '9999999999',
            'address' => 'New York, United States',
            'description' => 'Pellentesque vel vestibulum nunc. Sed eu ante nunc. Proin non vestibulum ipsum. Curabitur quis maximus lorem, eu elementum erat. Aliquam erat volutpat. Integer nec bibendum ex. Nulla nec maximus nisl,',
            'footer_copyright' => 'Copyright © All Rights Reserved.',
            'layouts' => '4',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_settings');
    }
};
