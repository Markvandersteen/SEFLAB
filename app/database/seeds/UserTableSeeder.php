<?php

class UserTableSeeder extends Seeder
{

	public function run()
	{
		DB::table('user')->truncate();
		User::create(array(
			
			'username' => 'sfl',			
			'password' => Hash::make('sfl'),
			'email' => 'sfl@slf.nl',
			'first_name' => 'First_Name_sfl',
			'last_name' => 'Last_name_sfl',
			'company' => "slf_Company",
			'phone' => '0612345678',

		));
	}

}

	