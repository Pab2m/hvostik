<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{Schema::create('regions', function(Blueprint $table)
		{
		$table->increments('id')->index();
		$table->integer('country_id');
                $table->integer('city_id');
		$table->string('name',128);
                });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
