<?php namespace Aedart\React\Demo;

use Aedart\React\Demo\Containers\IoC;
use Aedart\React\Demo\Traits\EventLoop;
use Aedart\React\Demo\Traits\ServiceContainer;
use React\EventLoop\Factory as EventLoopFactory;
use React\EventLoop\LoopInterface;

/**
 * Application
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\React\Demo
 */
abstract class Application
{
    use ServiceContainer;
    use EventLoop;

    public function __construct()
    {
        $this->initIoC();
        $this->registerBinding();
    }

    public function run()
    {
        $this->setupApplication();

        $this->getEventLoop()->run();
    }

    abstract public function setupApplication();

    /**
     * Init the service container
     */
    protected function initIoC()
    {
        // Will boot the IoC
        IoC::getInstance();
    }

    /**
     * Register bindings for application.
     * Normally this goes inside service providers
     */
    protected function registerBinding()
    {
        $ioc = $this->getContainer();

        // React Event loop
        $ioc->singleton(LoopInterface::class, function($ioc){
            return EventLoopFactory::create();
        });
    }

}