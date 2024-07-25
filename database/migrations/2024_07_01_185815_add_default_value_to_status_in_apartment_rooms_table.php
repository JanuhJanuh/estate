<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultValueToStatusInApartmentRoomsTable extends Migration
{
    public function up()
    {
        Schema::table('apartment_rooms', function (Blueprint $table) {
            $table->string('status')->default('vacant')->change();
        });
    }

    public function down()
    {
        Schema::table('apartment_rooms', function (Blueprint $table) {
            $table->string('status')->default(null)->change();
        });
    }
}

