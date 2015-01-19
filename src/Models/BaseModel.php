<?php namespace Arcanedev\GeoIP\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Support\Facades\Config;

class BaseModel extends Model
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    protected $tableKey = '';

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    public function __construct($attributes = [])
    {
        $this->connection  = $this->getConfig('connection');
        $this->table       = $this->getPrefix() . $this->getConfig('table.' . $this->tableKey);

        parent::__construct($attributes = []);
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
     * Get Config
     *
     * @param string $name
     *
     * @return string
     */
    private function getConfig($name)
    {
        return Config::get('geo-ip::config.' . $name);
    }
}
