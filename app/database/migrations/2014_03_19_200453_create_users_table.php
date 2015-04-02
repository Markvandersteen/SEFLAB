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
		Schema::create('user', function($table)
		{
		    $table->increments('id');
		    $table->string('username');
		    $table->string('password');
		    $table->string('email');
		    $table->string('first_name');
		    $table->string('last_name');
		    $table->string('company')->nullable();
		    $table->string('phone')->nullable();
		    $table->string('remember_token', 100)->nullable();

		    // Created_at, Updated_at
		    $table->timestamps();
		    // Deleted_at
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
		Schema::dropIfExists('user');
	}

}
