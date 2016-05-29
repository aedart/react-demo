<?php namespace Aedart\React\Demo;

use Aedart\React\Demo\Containers\IoC;
use Aedart\React\Demo\Traits\EventLoop;
use Aedart\React\Demo\Traits\ServiceContainer;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Facade;
use React\EventLoop\Factory;
use React\EventLoop\LoopInterface;

/**
 * Application
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\React\Demo
 */
class Application
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
        $loop = $this->getEventLoop();

        // Here we normally would start a Http server
        // or other service, e.g. sockets... etc.
        $loop->tick();
    }

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
            return Factory::create();
        });
    }

}