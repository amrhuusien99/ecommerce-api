<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBrandsTable extends Migration {

	public function up()
	{
		Schema::create('brands', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('photo')->nullable();
			$table->string('is_activate')->default('1');
		});
	}

	public function down()
	{
		Schema::drop('brands');
	}
}