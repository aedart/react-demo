<?php namespace Aedart\React\Demo\Requests;

use Aedart\React\Demo\Contracts\Requests\Request;

/**
 * Abstract Request
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\React\Demo\Requests
 */
abstract class RequestBase implements Request
{
    /**
     * Request Data - key value pairs
     *
     * @var array|null
     */
    protected $data = null;

    /**
     * RequestBase constructor.
     *
     * @param array $data [optional]
     */
    public function __construct(array $data = [])
    {
        $this->setData($data);
    }

    /**
     * Set the given data
     *
     * @param array $data Request Data - key value pairs
     *
     * @return void
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }

    /**
     * Get the given data
     *
     * If no data has been set, this method will
     * set and return a default data, if any such
     * value is available
     *
     * @see getDefaultData()
     *
     * @return array|null data or null if none data has been set
     */
    public function getData()
    {
        if (!$this->hasData() && $this->hasDefaultData()) {
            $this->setData($this->getDefaultData());
        }
        return $this->data;
    }

    /**
     * Get a default data value, if any is available
     *
     * @return array|null A default data value or Null if no default value is available
     */
    public function getDefaultData()
    {
        return null;
    }

    /**
     * Check if data has been set
     *
     * @return bool True if data has been set, false if not
     */
    public function hasData()
    {
        return !is_null($this->data);
    }

    /**
     * Check if a default data is available or not
     *
     * @return bool True of a default data is available, false if not
     */
    public function hasDefaultData()
    {
        return !is_null($this->getDefaultData());
    }
}