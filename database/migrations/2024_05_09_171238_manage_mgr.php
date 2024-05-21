<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('manage_mgr', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('manager_id');
            $table->unsignedBigInteger('apartment_id');
            $table->date('start_date');
            $table->date('entry_date')->nullable(); // Added entry_date field with nullable
            $table->string('status', 50);
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('manager_id')->references('id')->on('managers')->onDelete('cascade');
            $table->foreign('apartment_id')->references('id')->on('_property')->onDelete('cascade');
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
