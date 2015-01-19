<?php namespace Arcanedev\GeoIP\Laravel\Migrations;

use Closure;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class BaseMigration extends Migration
{
    /* ------------------------------------------------------------------------------------------------
	 |  Properties
	 | ------------------------------------------------------------------------------------------------
	 */
    protected $name;

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get Connection
     *
     * @return string
     */
    protected function connection()
    {
        return $this->getConfig('connection');
    }

    /**
     * Get Prefix
     *
     * @return string
     */
    private function getPrefix()
    {
        return $this->getConfig('prefix');
    }

    /**
     * Get Table name
     *
     * @return string
     */
    private function getTable()
    {
        return $this->getConfig('table.' . $this->name);
    }

    /**
     * Get Prefixed Table name
     *
     * @return mixed
     */
    private function tableName()
    {
        return $this->getPrefix() . $this->getTable();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Create migration table
     *
     * @param callable $blueprint
     */
    public function create(Closure $blueprint)
    {
        Schema::connection($this->connection())
            ->create($this->tableName(), $blueprint);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection($this->connection())
            ->dropIfExists($this->tableName());
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get Config
     *
     * @param string $name
     *
     * @return string
     */
    public function getConfig($name)
    {
        return Config::get('geo-ip::config.' . $name);
    }
}
