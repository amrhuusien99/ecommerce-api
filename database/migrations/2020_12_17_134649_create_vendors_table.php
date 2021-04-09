<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVendorsTable extends Migration {

	public function up()
	{
		Schema::create('vendors', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('email');
			$table->string('phone');
			$table->string('password');
			$table->string('minimum_order');
			$table->enum('state', ["open","close"]);
			$table->string('photo')->nullable();
			$table->string('address')->nullable();
			$table->integer('is_activate')->default('1');
			$table->integer('top')->default('0');
			$table->integer('pin_code')->nullable();
			$table->string('api_token')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('vendors');
	}
}