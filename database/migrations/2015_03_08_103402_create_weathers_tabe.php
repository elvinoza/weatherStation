<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeathersTabe extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('weathers', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('user_id', 6);
            $table->double('temperature',4,2);
            $table->double('humidity',4,2);
            $table->double('light_level',4,2);
            $table->double('pressure',4,2);
            $table->double('wind_direction',4,2);
            $table->double('wind_speed',4,2);
            $table->double('rain',4,2);
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
		Schema::drop('weathers');
	}

}
