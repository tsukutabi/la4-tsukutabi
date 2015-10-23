<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		schema::create( 'users', function( Blueprint $table )
		{
			$table->increments( 'id' );
			$table->string( 'username', 64 );
			$table->string( 'email', 320 );
			$table->string( 'password', 60 );
			$table->smallInteger( 'active' )->default( 0 );
			$table->smallInteger( 'suspended' )->default( 0 );
			$table->smallInteger( 'role' )->default( 0 );
			$table->string( 'remember_token' )->nullable();
			$table->timestamps();
			$table->softDeletes();
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
	}

}
