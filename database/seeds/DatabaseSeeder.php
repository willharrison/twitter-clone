<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('UserTableSeeder');
	}

}

class UserTableSeeder extends Seeder {

	public function run()
	{
		DB::table('users')->delete();

		Twitter\User::create(array(
			'name' => 'foo',
			'email' => 'foo@bar.com',
			'password' => Hash::make('testtest')
		));

		Twitter\User::create(array(
			'name' => 'bar',
			'email' => 'bar@bar.com',
			'password' => Hash::make('testtest')
		));
	}

}