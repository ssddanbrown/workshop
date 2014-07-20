<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('StateTableSeeder');
		$this->command->info('State table seeded!');
	}

}

class StateTableSeeder extends Seeder {

	public function run()
	{
		DB::table('states')->delete();
		DB::table('users')->delete();

		State::create( ['name'=>'Outstanding', 'value'=>0] );
		State::create( ['name'=>'Complete', 'value'=>12] );
		User::create( [
			'username' => 'admin',
			'email' => 'admin@admin.com',
			'first_name' => 'Mister',
			'last_name'	=> 'Admin',
			'password' => Hash::make('admin')
			] );
	}

}