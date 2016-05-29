<?php namespace Aedart\React\Demo\Containers;

use Illuminate\Container\Container;
use Illuminate\Support\Facades\Facade;

/**
 * Class IoC
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\React\Demo\Containers
 */
class IoC
{

    static protected $instance;

    protected $container;

    private function __construct()
    {
        $this->container = new Container();

        $this->container->singleton('app', $this->container);

        Facade::setFacadeApplication($this->container);
    }

    public function getContainer()
    {
        return $this->container;
    }

    static public function getInstance()
    {
        if(null === self::$instance){
            self::$instance = new static;
        }

        return self::$instance;
    }

    static public function make($abstract, array $parameters = [])
    {
        return self::getInstance()->getContainer()->make($abstract, $parameters);
    }
}