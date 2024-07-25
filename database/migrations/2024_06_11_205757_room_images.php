<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RoomImages extends Migration
{
    // CreateRoomImagesTable.php

public function up()
{
    Schema::create('room_images', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('apartment_room_id');
        $table->string('image_path');
        $table->timestamps();

        $table->foreign('apartment_room_id')->references('id')->on('apartment_rooms')->onDelete('cascade');
    });
}

public function down()
{
    Schema::dropIfExists('room_images');
}

}
