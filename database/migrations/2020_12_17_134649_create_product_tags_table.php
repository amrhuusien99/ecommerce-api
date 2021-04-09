<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductTagsTable extends Migration {

	public function up()
	{
		Schema::create('product_tags', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('product_id');
			$table->integer('tag_id');
		});
	}

	public function down()
	{
		Schema::drop('product_tags');
	}
}