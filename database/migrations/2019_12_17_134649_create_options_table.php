<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOptionsTable extends Migration {

	public function up()
	{
		Schema::create('options', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('attribute_id');
			$table->string('product_id');
			$table->integer('is_activate')->default('1');
		});
	}

	public function down()
	{
		Schema::drop('options');
	}
}