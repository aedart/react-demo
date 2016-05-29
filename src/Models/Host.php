<?php namespace Aedart\React\Demo\Models;

/**
 * Class Host
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\React\Demo\Models
 */
class Host
{
    /**
     * Host Name
     *
     * @var string|null
     */
    protected $hostName = null;

    /**
     * ip
     *
     * @var string|null
     */
    protected $ip = null;

    public function __construct($ip = null, $hostName = null)
    {
        // Could be populated via DTO style
        $this->setIp($ip);
        $this->setHostName($hostName);
    }

    /**
     * Set the given host name
     *
     * @param string $hostName Host Name
     *
     * @return void
     */
    public function setHostName($hostName)
    {
        $this->hostName = $hostName;
    }

    /**
     * Get the given host name
     *
     * If no host name has been set, this method will
     * set and return a default host name, if any such
     * value is available
     *
     * @see getDefaultHostName()
     *
     * @return string|null host name or null if none host name has been set
     */
    public function getHostName()
    {
        if (!$this->hasHostName() && $this->hasDefaultHostName()) {
            $this->setHostName($this->getDefaultHostName());
        }
        return $this->hostName;
    }

    /**
     * Get a default host name value, if any is available
     *
     * @return string|null A default host name value or Null if no default value is available
     */
    public function getDefaultHostName()
    {
        return null;
    }

    /**
     * Check if host name has been set
     *
     * @return bool True if host name has been set, false if not
     */
    public function hasHostName()
    {
        return !is_null($this->hostName);
    }

    /**
     * Check if a default host name is available or not
     *
     * @return bool True of a default host name is available, false if not
     */
    public function hasDefaultHostName()
    {
        return !is_null($this->getDefaultHostName());
    }

    /**
     * Set the given ip
     *
     * @param string $ip ip
     *
     * @return void
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    /**
     * Get the given ip
     *
     * If no ip has been set, this method will
     * set and return a default ip, if any such
     * value is available
     *
     * @see getDefaultIp()
     *
     * @return string|null ip or null if none ip has been set
     */
    public function getIp()
    {
        if (!$this->hasIp() && $this->hasDefaultIp()) {
            $this->setIp($this->getDefaultIp());
        }
        return $this->ip;
    }

    /**
     * Get a default ip value, if any is available
     *
     * @return string|null A default ip value or Null if no default value is available
     */
    public function getDefaultIp()
    {
        return null;
    }

    /**
     * Check if ip has been set
     *
     * @return bool True if ip has been set, false if not
     */
    public function hasIp()
    {
        return !is_null($this->ip);
    }

    /**
     * Check if a default ip is available or not
     *
     * @return bool True of a default ip is available, false if not
     */
    public function hasDefaultIp()
    {
        return !is_null($this->getDefaultIp());
    }

    public function __toString()
    {
        return $this->getIp() . ' ' . $this->getHostName();
    }
}