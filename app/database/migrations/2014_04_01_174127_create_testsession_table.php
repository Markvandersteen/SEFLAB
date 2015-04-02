<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestsessionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('testsession', function($table)
		{
		    $table->increments('id');
		    $table->unsignedInteger('loadscript_id');
		    $table->unsignedInteger('status')->default(1);
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
		Schema::dropIfExists('testsession');
	}

}
