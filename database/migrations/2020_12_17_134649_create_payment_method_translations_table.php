<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentMethodTranslationsTable extends Migration {

	public function up()
	{
		Schema::create('payment_method_translations', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('locale');
			$table->integer('payment_method_id')->unsigned();

			$table->unique(['payment_method_id', 'locale']);
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('cascade');
		});
	}

	public function down()
	{
		Schema::drop('payment_method_translations');
	}
}