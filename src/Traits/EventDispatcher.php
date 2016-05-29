<?php namespace Aedart\React\Demo\Traits;

use Aedart\React\Demo\Containers\IoC;
use Illuminate\Contracts\Events\Dispatcher;

/**
 * Trait EventDispatcher
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\React\Demo\Traits
 */
trait EventDispatcher
{
    /**
     * Instance of the Event Dispatcher
     *
     * @var Dispatcher|null
     */
    protected $eventDispatcher = null;

    /**
     * Set the given event dispatcher
     *
     * @param Dispatcher $dispatcher Instance of the Event Dispatcher
     *
     * @return void
     */
    public function setEventDispatcher(Dispatcher $dispatcher)
    {
        $this->eventDispatcher = $dispatcher;
    }

    /**
     * Get the given event dispatcher
     *
     * If no event dispatcher has been set, this method will
     * set and return a default event dispatcher, if any such
     * value is available
     *
     * @see getDefaultEventDispatcher()
     *
     * @return Dispatcher|null event dispatcher or null if none event dispatcher has been set
     */
    public function getEventDispatcher()
    {
        if (!$this->hasEventDispatcher() && $this->hasDefaultEventDispatcher()) {
            $this->setEventDispatcher($this->getDefaultEventDispatcher());
        }
        return $this->eventDispatcher;
    }

    /**
     * Get a default event dispatcher value, if any is available
     *
     * @return Dispatcher|null A default event dispatcher value or Null if no default value is available
     */
    public function getDefaultEventDispatcher()
    {
        return IoC::make(Dispatcher::class);
    }

    /**
     * Check if event dispatcher has been set
     *
     * @return bool True if event dispatcher has been set, false if not
     */
    public function hasEventDispatcher()
    {
        return !is_null($this->eventDispatcher);
    }

    /**
     * Check if a default event dispatcher is available or not
     *
     * @return bool True of a default event dispatcher is available, false if not
     */
    public function hasDefaultEventDispatcher()
    {
        return !is_null($this->getDefaultEventDispatcher());
    }
}