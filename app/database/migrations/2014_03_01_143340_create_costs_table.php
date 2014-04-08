<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('costs', function($table){

			$table->increments('id');
			$table->integer('job_id');
			$table->decimal('cost_qty', 16, 2);
			$table->text('cost_text');
			$table->decimal('cost_price', 16, 2);
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
		Schema::drop('costs');
	}

}
