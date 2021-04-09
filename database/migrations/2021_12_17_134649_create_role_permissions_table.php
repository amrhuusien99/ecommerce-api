<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRolePermissionsTable extends Migration {

	public function up()
	{
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->integer('role_id')->unsigned();
            $table->integer('permission_id')->unsigned();
            $table->timestamps();

            $table->primary(['role_id', 'permission_id']);
			$table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
			$table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
        });
	}

	public function down()
	{
		Schema::drop('role_permissions');
	}
}