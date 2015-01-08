<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeoCountriesTable extends Migration
{
	/* ------------------------------------------------------------------------------------------------
	 |  Properties
	 | ------------------------------------------------------------------------------------------------
	 */
	protected $connection;

	protected $table;

	/* ------------------------------------------------------------------------------------------------
	 |  Constructor
	 | ------------------------------------------------------------------------------------------------
	 */
	public function __construct()
	{
		$this->connection = 'sqlite';
		$this->table      = 'geo_countries';
	}

	/* ------------------------------------------------------------------------------------------------
	 |  Functions
	 | ------------------------------------------------------------------------------------------------
	 */
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection($this->connection)->create($this->table, function(Blueprint $table)
		{
			$table->string('code', 4)->default('');
			$table->string('iso_code_2', 2)->default('');
			$table->string('iso_code_3', 3)->default('');
			$table->string('iso_country', 255)->default('');
			$table->string('country', 255)->default('');
			$table->float('lat')->default(0);
			$table->float('lon')->default(0);

			$table->primary('code');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists($this->table);
	}
}
