<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSliderTranslationsTable extends Migration {

	public function up()
	{
		Schema::create('slider_translations', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title')->nullable();
			$table->string('description')->nullable();
			$table->string('locale');
			$table->integer('slider_id')->unsigned();

			$table->unique(['slider_id', 'locale']);
            $table->foreign('slider_id')->references('id')->on('sliders')->onDelete('cascade');
		});
	}

	public function down()
	{
		Schema::drop('slider_translations');
	}
}