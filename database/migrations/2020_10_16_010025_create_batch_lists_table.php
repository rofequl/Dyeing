<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batch_lists', function (Blueprint $table) {
            $table->id();
            $table->integer('order_list_id');
            $table->integer('batch_id');
            $table->string('mark_hole')->nullable();
            $table->string('y_lot')->nullable();
            $table->string('grey_wt')->nullable();
            $table->string('finished_qty')->default(0);
            $table->string('waste')->default(0);
            $table->boolean('finished_received')->default(0);
            $table->string('roll')->nullable();
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
        Schema::dropIfExists('batch_lists');
    }
}
