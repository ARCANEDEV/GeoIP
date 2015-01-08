<?php

use Illuminate\Database\Schema\Blueprint;
use Arcanedev\GeoIP\migrations\BaseMigration;

class CreateGeoNationsTable extends BaseMigration
{
	/* ------------------------------------------------------------------------------------------------
	 |  Properties
	 | ------------------------------------------------------------------------------------------------
	 */
	protected $name = 'nations';

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
		$this->create(function(Blueprint $table)
		{
			$table->increments('ip');
			$table->string('code', 2)->default('');
		});
	}
}
