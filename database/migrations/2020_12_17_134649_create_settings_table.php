<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('email');
			$table->string('phone');
			$table->string('facebook');
			$table->string('insta')->nullable();
			$table->string('whats_app')->nullable();
			$table->string('bank_name')->nullable();
			$table->integer('commission');
			$table->string('app_link');
			$table->string('twitter')->nullable();
			$table->string('youtube')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}