<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeoNationsTable extends Migration
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
		$this->table      = 'geo_nations';
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
			$table->increments('ip');
			$table->string('code', 2)->default('');
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
