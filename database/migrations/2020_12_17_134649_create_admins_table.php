<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdminsTable extends Migration {

	public function up()
	{
		Schema::create('admins', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('email');
			$table->string('password');
			$table->string('phone');
			$table->string('photo')->nullable();
			$table->integer('is_activate')->default('1');
			$table->integer('pin_code')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('admins');
	}
}