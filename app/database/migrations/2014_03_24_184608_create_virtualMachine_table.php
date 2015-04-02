<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVirtualMachineTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('virtualmachine', function($table)
		{
		    $table->increments('id');
		    $table->string('file_path');
		    $table->string('file_name');
		    $table->string('file_size');
		    $table->string('vm_description');
		    $table->unsignedInteger('user_id');
		       
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
	     Schema::dropIfExists('virtualmachine');	
	}

}