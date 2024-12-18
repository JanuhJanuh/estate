<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMpayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mpay_table', function (Blueprint $table) {
            $table->id(); // Auto-increment ID
            $table->string('transaction_id')->unique(); // Unique M-Pesa transaction ID
            $table->string('phone_number');
            $table->string('room_number');
            $table->foreignId('tenant_id')->constrained('tenants')->onDelete('cascade');
            $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->decimal('balance', 10, 2)->default(0); //incase of less/excess payments
            $table->string('status')->default('Pending'); // Status (e.g., Pending, Successful, Failed)
            $table->timestamp('transaction_date')->nullable(); // Date of transaction
            $table->string('confirmationId_code')->nullable(); // M-Pesa confirmation code
            $table->string('description')->nullable(); // Describe payment for deposit or rent
            $table->timestamps(); // Created at and Updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mpay_table');
    }
}
