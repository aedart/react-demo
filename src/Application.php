<?php namespace Aedart\React\Demo;

use Aedart\React\Demo\Traits\EventLoop;
use Aedart\React\Demo\Traits\ServiceContainer;
use Illuminate\Container\Container;
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
        print "Hallo world" . PHP_EOL;
    }

    /**
     * Init the service container
     */
    protected function initIoC()
    {
        $container = new Container();
        $container->setInstance($container);

        Facade::setFacadeApplication($container);

        $container->singleton('app', $container);
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