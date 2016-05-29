<?php namespace Aedart\React\Demo\Traits;

use Illuminate\Support\Facades\App;
use React\EventLoop\LoopInterface;

/**
 * Trait EventLoop
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\React\Demo\Traits
 */
trait EventLoop
{
    /**
     * React's Event Loop
     *
     * @var LoopInterface|null
     */
    protected $eventLoop = null;

    /**
     * Set the given event loop
     *
     * @param LoopInterface $loop React's Event Loop
     *
     * @return void
     */
    public function setEventLoop(LoopInterface $loop)
    {
        $this->eventLoop = $loop;
    }

    /**
     * Get the given event loop
     *
     * If no event loop has been set, this method will
     * set and return a default event loop, if any such
     * value is available
     *
     * @see getDefaultEventLoop()
     *
     * @return LoopInterface|null event loop or null if none event loop has been set
     */
    public function getEventLoop()
    {
        if (!$this->hasEventLoop() && $this->hasDefaultEventLoop()) {
            $this->setEventLoop($this->getDefaultEventLoop());
        }
        return $this->eventLoop;
    }

    /**
     * Get a default event loop value, if any is available
     *
     * @return LoopInterface|null A default event loop value or Null if no default value is available
     */
    public function getDefaultEventLoop()
    {
        return App::make(LoopInterface::class);
    }

    /**
     * Check if event loop has been set
     *
     * @return bool True if event loop has been set, false if not
     */
    public function hasEventLoop()
    {
        return !is_null($this->eventLoop);
    }

    /**
     * Check if a default event loop is available or not
     *
     * @return bool True of a default event loop is available, false if not
     */
    public function hasDefaultEventLoop()
    {
        return !is_null($this->getDefaultEventLoop());
    }
}