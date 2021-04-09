<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAttributeTranslationsTable extends Migration {

	public function up()
	{
		Schema::create('attribute_translations', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('locale');
			$table->integer('attribute_id')->unsigned();

			$table->unique(['attribute_id', 'locale']);
			$table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
		});
	}

	public function down()
	{
		Schema::drop('attribute_translations');
	}
}