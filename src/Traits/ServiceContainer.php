<?php namespace Aedart\React\Demo\Traits;

use Aedart\React\Demo\Containers\IoC;
use Illuminate\Contracts\Container\Container;

/**
 * Trait ServiceContainer
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\React\Demo\Traits
 */
trait ServiceContainer
{
    /**
     * The IoC
     *
     * @var Container|null
     */
    protected $container = null;

    /**
     * Set the given container
     *
     * @param Container $ioc The IoC
     *
     * @return void
     */
    public function setContainer(Container $ioc)
    {
        $this->container = $ioc;
    }

    /**
     * Get the given container
     *
     * If no container has been set, this method will
     * set and return a default container, if any such
     * value is available
     *
     * @see getDefaultContainer()
     *
     * @return Container|null container or null if none container has been set
     */
    public function getContainer()
    {
        if (!$this->hasContainer() && $this->hasDefaultContainer()) {
            $this->setContainer($this->getDefaultContainer());
        }
        return $this->container;
    }

    /**
     * Get a default container value, if any is available
     *
     * @return Container|null A default container value or Null if no default value is available
     */
    public function getDefaultContainer()
    {
        return IoC::getInstance()->getContainer();
    }

    /**
     * Check if container has been set
     *
     * @return bool True if container has been set, false if not
     */
    public function hasContainer()
    {
        return !is_null($this->container);
    }

    /**
     * Check if a default container is available or not
     *
     * @return bool True of a default container is available, false if not
     */
    public function hasDefaultContainer()
    {
        return !is_null($this->getDefaultContainer());
    }
}