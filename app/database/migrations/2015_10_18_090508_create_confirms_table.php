<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfirmsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create( 'confirms', function( Blueprint $table )
		{
			$table->increments( 'id' );
			$table->unsignedInteger( 'user_id' );
			$table->string( 'key' );
			$table->timestamps();

			$table->foreign( 'user_id' )
				->references( 'id' )->on( 'users' )
				->onDelete( 'cascade' )
				->onUpdate( 'cascade' );
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
