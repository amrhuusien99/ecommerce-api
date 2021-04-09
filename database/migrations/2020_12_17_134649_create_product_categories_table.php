<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductCategoriesTable extends Migration {

	public function up()
	{
		Schema::create('product_categories', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('product_id');
			$table->integer('category_id');
		});
	}

	public function down()
	{
		Schema::drop('product_categories');
	}
}