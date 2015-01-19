<?php

use Arcanedev\GeoIP\Laravel\Migrations\BaseMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateGeoCountriesTable extends BaseMigration
{
	/* ------------------------------------------------------------------------------------------------
	 |  Properties
	 | ------------------------------------------------------------------------------------------------
	 */
	protected $name = 'countries';

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
}
