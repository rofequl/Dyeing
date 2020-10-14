<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batches', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('order_list_id');
            $table->date('date');
            $table->string('batch_no')->unique();
            $table->string('machine_no')->nullable();
            $table->string('po_no')->nullable();
            $table->string('compostion')->nullable();
            $table->string('stitch_length')->nullable();
            $table->string('mark_hole')->nullable();
            $table->string('y_lot')->nullable();
            $table->string('gray_wt')->nullable();
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
        Schema::dropIfExists('batches');
    }
}
