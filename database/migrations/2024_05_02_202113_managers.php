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
        Schema::create('Managers', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->int('ID');
            $table->string('DOB');
            $table->string('Gender');
            $table->char('PhoneNo');
            $table->string('Email');
            $table->string('Image');
            $table->string('Address');
            $table->string('Password');
            $table->timestamps();
        });
    }


    /**
     * Reverse tzhe migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Managers');
    }
};
