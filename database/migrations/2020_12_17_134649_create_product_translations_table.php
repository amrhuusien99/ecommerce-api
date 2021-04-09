<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductTranslationsTable extends Migration {

	public function up()
	{
		Schema::create('product_translations', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('locale');
			$table->string('description');
			$table->string('short_description')->nullable();
			$table->integer('product_id')->unsigned();

			$table->unique(['product_id', 'locale']);
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
		});
	}

	public function down()
	{
		Schema::drop('product_translations');
	}
}