<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTagsTranslationsTable extends Migration {

	public function up()
	{
		Schema::create('tags_translations', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('locale');
			$table->integer('tag_id')->unsigned();

			$table->unique(['tag_id', 'locale']);
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
		});
	}

	public function down()
	{
		Schema::drop('tags_translations');
	}
}