<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBrandTranslationsTable extends Migration {

	public function up()
	{
		Schema::create('brand_translations', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('locale');
			$table->integer('brand_id')->unsigned(); 

			$table->unique(['brand_id', 'locale']);
			$table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
		});
	}

	public function down()
	{
		Schema::drop('brand_translations');
	}
}