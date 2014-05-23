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

		State::create( ['name'=>'Outstanding', 'value'=>0] );
		State::create( ['name'=>'Complete', 'value'=>12] );
	}

}