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
            $table->string('chalan_no')->nullable();
            $table->string('today_receive');
            $table->string('dia')->nullable();
            $table->string('gsm')->nullable();
            $table->string('remarks')->nullable();
            $table->integer('lab_id')->nullable();
            $table->boolean('lab_status')->default(0);
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
