<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('report', function($table)
		{
		    $table->increments('id');
		    $table->string('file_path');
		    $table->unsignedInteger('testsession_id');
		       
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
		Schema::dropIfExists('report');
	}

}
