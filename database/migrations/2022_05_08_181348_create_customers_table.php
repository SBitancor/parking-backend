<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->dateTime('checkIn');
            $table->dateTime('checkOut')->nullable();
            $table->string('vehicleType');
            $table->string('vehiclePlate', 6);
            $table->string('vehicleModel');
            $table->string('contactNumber', 10);
            $table->float('price', 10, 2)->nullable();
            $table->float('received', 10, 2)->nullable();
            $table->float('change', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
