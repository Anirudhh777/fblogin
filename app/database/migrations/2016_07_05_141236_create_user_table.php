<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		Schema::create('users', function($table) {
			$table->increments('id');
			$table->string('name');
			$table->string('password');
			$table->bigInteger('uid_fb');
			$table->string('access_token_fb');
			$table->string('remember_token');
			$table->longText('pages');
			$table->timestamps();
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	Schema::drop('users');
	}

}
