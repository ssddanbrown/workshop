<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJobStates extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('jobs', function($table)
		{
			$table->dropColumn('finished');
			$table->integer('state_id');
		});

		Schema::create('states', function($table)
		{
			$table->increments('id');
			$table->text('name');
			$table->integer('value');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('jobs', function($table)
		{
			$table->dropColumn('state_id');
			$table->boolean('finished');
		});
	}

}
