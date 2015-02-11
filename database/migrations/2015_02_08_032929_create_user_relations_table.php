<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRelationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_relations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('follower_id')->unsigned();
			$table->integer('followed_id')->unsigned();
			$table->timestamps();

			$table->foreign('follower_id')->references('id')->on('users');
			$table->foreign('followed_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_relations');
	}

}
