<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labs', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('order_list_id');
            $table->string('lab_name');
            $table->string('grey_receive');
            $table->string('remaining_grey')->default(0);
            $table->string('batch_amount')->default(0);
            $table->string('grey_id');
            $table->boolean('batch_status')->default(0);
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
        Schema::dropIfExists('labs');
    }
}
