<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Comments extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('tags', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('comment');
			$table->timestamps();
			$table->softDeletes();
			$table->engine = 'InnoDB';

			$table->foreign('article_id')->references('id')->on('articles')->onUpdate('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::drop('comments');
	}

}
