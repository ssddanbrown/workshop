<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('jobs', function($table){

			$table->increments('id');
			$table->text('title');
			$table->text('text');
			$table->boolean('finished');
			$table->dateTime('due');
			$table->integer('customer');
			$table->longText('items');
			$table->longText('costs');
			$table->timestamps();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('jobs');
	}

}
