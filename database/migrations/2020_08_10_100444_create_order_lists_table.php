<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_lists', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('buyer_id');
            $table->integer('style_id')->nullable();
            $table->string('work_order')->nullable();
            $table->string('yarn_count')->nullable();
            $table->string('fabrics_type')->nullable();
            $table->string('dia')->nullable();
            $table->string('f_dia')->nullable();
            $table->string('gray_gsm')->nullable();
            $table->string('gsm')->nullable();
            $table->integer('colour_id')->nullable();
            $table->string('quantity')->nullable();
            $table->string('remaining')->default(0);
            $table->string('grey_received')->default(0);
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
        Schema::dropIfExists('order_lists');
    }
}
