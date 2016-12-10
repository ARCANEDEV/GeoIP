<?php namespace Arcanedev\GeoIP;

use ArrayAccess;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * Class     Location
 *
 * @package  Arcanedev\GeoIP
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property  string     ip
 * @property  string     iso_code
 * @property  string     country
 * @property  string     city
 * @property  string     state
 * @property  string     state_code
 * @property  string     postal_code
 * @property  float      latitude
 * @property  float      longitude
 * @property  string     timezone
 * @property  string     continent
 *
 * @property  bool       display_name
 * @property  bool       default
 * @property  bool|null  cached
 * @property  string     currency
 */
class Location implements ArrayAccess, Arrayable, Jsonable
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * The location's attributes
     *
     * @var array
     */
    protected $attributes = [];

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Create a new location instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->attributes = $attributes;
    }

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get all attributes.
     *
     * @return array
     */
    public function attributes()
    {
        return $this->attributes;
    }

    /**
     * Get an attribute from the $attributes array.
     *
     * @param  string  $key
     *
     * @return mixed
     */
    public function getAttribute($key)
    {
        $value = Arr::get($this->attributes(), $key);

        return method_exists($this, $method = 'get'.Str::studly($key).'Attribute')
            ? $this->{$method}($value)
            : $value;
    }

    /**
     * Set a given attribute on the location.
     *
     * @param  string  $key
     * @param  mixed   $value
     *
     * @return $this
     */
    public function setAttribute($key, $value)
    {
        $this->attributes[$key] = $value;

        return $this;
    }

    /**
     * Return the display name of the location.
     *
     * @return string
     */
    public function getDisplayNameAttribute()
    {
        return preg_replace('/^,\s/', '', "{$this->city}, {$this->state_code}");
    }

    /**
     * Is the location the default.
     *
     * @param  mixed  $value
     *
     * @return mixed
     */
    public function getDefaultAttribute($value)
    {
        return is_null($value) ? false : $value;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->attributes();
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param  int  $options
     *
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Check Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Determine if the location is for the same IP address.
     *
     * @param  string  $ip
     *
     * @return bool
     */
    public function same($ip)
    {
        return $this->getAttribute('ip') === $ip;
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Determine if the given attribute exists.
     *
     * @param  mixed  $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->$offset);
    }

    /**
     * Get the value for a given offset.
     *
     * @param  string  $offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->__get($offset);
    }

    /**
     * Set the value for a given offset.
     *
     * @param  string  $offset
     * @param  mixed   $value
     */
    public function offsetSet($offset, $value)
    {
        $this->__set($offset, $value);
    }

    /**
     * Get the location's attribute
     *
     * @param  string  $key
     *
     * @return mixed
     */
    public function __get($key)
    {
        return $this->getAttribute($key);
    }

    /**
     * Set the location's attribute
     *
     * @param  string  $key
     * @param  mixed   $value
     */
    public function __set($key, $value)
    {
        $this->setAttribute($key, $value);
    }

    /**
     * Check if the location's attribute is set
     *
     * @param  string  $key
     *
     * @return bool
     */
    public function __isset($key)
    {
        return array_key_exists($key, $this->attributes);
    }

    /**
     * Unset the value for a given offset.
     *
     * @param  string  $offset
     */
    public function offsetUnset($offset)
    {
        $this->__unset($offset);
    }

    /**
     * Unset an attribute on the location.
     *
     * @param  string  $key
     */
    public function __unset($key)
    {
        unset($this->attributes[$key]);
    }
}
