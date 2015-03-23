<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHashtagMapTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hashtag_map', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('hashtag_id')->unsigned();
			$table->integer('post_id')->unsigned();
			$table->timestamps();

			$table->foreign('hashtag_id')->references('id')->on('hashtag_index');
			$table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('hashtag_map');
	}

}
