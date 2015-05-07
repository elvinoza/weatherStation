<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameFieldsInUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('users', function($table)
        {
            $table->renameColumn('Description', 'description');
            $table->renameColumn('Location', 'location');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('users', function($table)
        {
            $table->renameColumn('description', 'Description');
            $table->renameColumn('location', 'Location');
        });
	}

}
