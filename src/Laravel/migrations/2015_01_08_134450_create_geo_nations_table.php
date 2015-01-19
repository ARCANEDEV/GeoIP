<?php

use Arcanedev\GeoIP\Laravel\Migrations\BaseMigration;
use Illuminate\Database\Schema\Blueprint;

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
