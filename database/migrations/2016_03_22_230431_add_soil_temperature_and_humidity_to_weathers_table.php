<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSoilTemperatureAndHumidityToWeathersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('weathers', function($table)
		{
			$table->double('soil_temperature', 4, 2)->after('rain');
			$table->double('soil_humidity', 5, 2)->after('soil_temperature');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('weathers', function($table)
		{
			$table->dropColumn('soil_temperature');
			$table->dropColumn('soil_humidity');
		});
	}

}
