<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function(Blueprint $table){
            $table->increments('id');
            $table->timestamps();
            $table->string('user_phone');
            $table->string('user_name');
            $table->string('address');
            $table->string('cost');
            $table->string('delivery_cost');
            $table->string('total_cost')->nullable();
            $table->string('commission');
            $table->string('net_cost')->nullable();
            $table->string('locale');
            $table->string('status');
            $table->enum('state', array('pending', 'rejected', 'completed'))->default('pending');
            $table->integer('payment_method_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('vendor_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
