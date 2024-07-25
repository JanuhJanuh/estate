<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentBookingTable extends Migration
{
    public function up()
    {
        Schema::create('apartment_booking', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('apartment_id');
            $table->unsignedBigInteger('room_id');
            $table->string('status');
            $table->timestamps();

            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('cascade');
            $table->foreign('apartment_id')->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('room_id')->references('id')->on('apartment_rooms')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('apartment_booking');
    }
}
