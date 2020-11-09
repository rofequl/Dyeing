<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->string('challan_no')->nullable();
            $table->integer('order_id');
            $table->date('date');
            $table->string('vehicle_no')->nullable();
            $table->string('driver_name')->nullable();
            $table->string('batch_no')->nullable();
            $table->string('total_grey')->nullable();
            $table->string('total_finish')->nullable();
            $table->string('total_roll')->nullable();
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
        Schema::dropIfExists('deliveries');
    }
}
