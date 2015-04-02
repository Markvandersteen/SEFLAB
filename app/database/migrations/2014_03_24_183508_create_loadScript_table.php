<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoadScriptTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('loadscript', function($table)
		{
		    $table->increments('id');
		    $table->string('file_path');
		    $table->string('file_name');
		    $table->string('file_size');
		    $table->unsignedInteger('virtualMachine_id');

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
		Schema::drop('loadscript');	
	}

}
