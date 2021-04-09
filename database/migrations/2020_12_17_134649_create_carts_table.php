<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCartsTable extends Migration {

	public function up()
	{
		Schema::create('carts', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('user_id');
			$table->integer('product_id');
			$table->integer('option_id')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('carts');
	}
}