<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentMethodsTable extends Migration {

	public function up()
	{
		Schema::create('payment_methods', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('is_activate')->default('1');
		});
	}

	public function down()
	{
		Schema::drop('payment_methods');
	}
}