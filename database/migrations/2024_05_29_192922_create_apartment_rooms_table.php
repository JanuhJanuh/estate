<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentRoomsTable extends Migration
{
public function up()
{
    Schema::create('apartment_rooms', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('apartment_id');
        $table->string('room_type');
        $table->string('room_number');
        $table->decimal('charges', 8, 2);
        $table->string('amenities');
        $table->string('overview');
        $table->json('images')->nullable();
        $table->string('status')->default('vacant'); // Add the status column with default value
        $table->timestamps();

        $table->foreign('apartment_id')->references('id')->on('apartments')->onDelete('cascade');
    });
}

public function down()
{
    Schema::dropIfExists('apartment_rooms');
}

}

