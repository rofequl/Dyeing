<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveriesListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries_lists', function (Blueprint $table) {
            $table->id();
            $table->integer('delivery_id');
            $table->integer('batch_list_id');
            $table->string('dia')->nullable();
            $table->string('grey_wt')->nullable();
            $table->string('finished_qty')->nullable();
            $table->string('roll')->nullable();
            $table->string('delivery_remarks')->nullable();
            $table->string('bill_remarks')->nullable();
            $table->string('unit_price')->nullable();
            $table->string('total_price')->nullable();
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
        Schema::dropIfExists('deliveries_lists');
    }
}
