<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Articles extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('articles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->string('subtitle');
			$table->string('photos');
			$table->string('photos_comments');
			$table->timestamps();
			$table->softDeletes();
			$table->engine = 'InnoDB';
			$table->index('title');
			$table->index('subtitle');
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
		Schema::dropIfExists('articles');
	}

}
