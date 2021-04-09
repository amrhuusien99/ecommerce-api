<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration {

	public function up()
	{
		Schema::create('categories', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('parent_id')->nullable();
			$table->string('slug');
			$table->integer('is_activate')->default('1');
		});
	}

	public function down()
	{
		Schema::drop('categories');
	}
}