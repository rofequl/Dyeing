<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGreysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('greys', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('order_list_id');
            $table->date('date');
            $table->string('total_qty');
            $table->string('today_receive');
            $table->string('remaining');
            $table->string('remarks')->nullable();
            $table->boolean('batch_create')->default(0);
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
        Schema::dropIfExists('greys');
    }
}
