<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('slug')->unique();
			$table->string('photo');
			$table->string('photos');
			$table->integer('quantity')->nullable();
			$table->string('sku')->nullable();
			$table->integer('price');
			$table->integer('special_price')->nullable();
			$table->string('special_price_start')->nullable();
			$table->string('special_price_end')->nullable();
			$table->integer('in_stock');
			$table->integer('is_activate')->default('0');
			$table->integer('special_product')->default('0');
			$table->integer('brand_id');
			$table->integer('vendor_id');
		});
	}

	public function down()
	{
		Schema::drop('products');
	}
}