<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePermissionsTable extends Migration {

	public function up()
	{
		Schema::create('permissions', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('route_name');
			$table->timestamps();
	
			$table->unique(['name', 'route_name']);
		}); 
	}

	public function down()
	{
		Schema::drop('permissions');
	}
}