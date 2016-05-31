<?php

use Aedart\React\Demo\DNS\ResolverContainer;
use Aedart\React\Demo\Models\EventDrivenDNS;
use Aedart\React\Demo\Models\Host;
use Aedart\React\Demo\Requests\InputRequest;
use Codeception\TestCase\Test;
use Aedart\React\Demo\Controllers\EventDNSController;
use Codeception\Util\Debug;
use Illuminate\Events\Dispatcher;
use React\EventLoop\Factory;
use React\EventLoop\Timer\TimerInterface;
use React\Promise\PromiseInterface;

/**
 * Class EventDNSControllerTest
 *
 * @group controllers
 * @group event-dns-controller
 * @coversDefaultClass Aedart\React\Demo\Controllers\EventDNSController
 *
 * @author Alin Eugen Deac <ade@vestergaardcompany.com>
 */
class EventDNSControllerTest extends Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var \React\EventLoop\LoopInterface
     */
    protected $loop;

    protected function _before()
    {
        $this->loop = Factory::create();

        $this->loop->addTimer(3, function(TimerInterface $timer) {
            Debug::debug('Timeout');
            $this->loop->stop();
        });
    }

    protected function _after()
    {
        $this->loop->stop();
    }

    /*******************************************
     * Helpers
     ******************************************/

    public function makeController($dns = null)
    {
        if(is_null($dns)){
            $dns = $this->makeDNS();
        }

        $controller = new EventDNSController($dns);
        $controller->setRequest($this->makeInputRequest());

        return $controller;
    }

    public function makeInputRequest()
    {
        return new InputRequest([
            'example.com',
            'blog.wyrihaximus.net',
            'wyrihaximus.net',
            'github.com',
            'google.com',
            'facebook.com',
        ]);
    }

    public function makeDNS()
    {
        $model =  new EventDrivenDNS($this->makeDNSResolverContainer());
        $model->setEventDispatcher($this->makeEventDispatcher());

        return $model;
    }

    public function makeDNSResolverContainer()
    {
        $container =  new ResolverContainer();
        $container->setEventLoop($this->loop);

        return $container;
    }

    public function makeEventDispatcher()
    {
        $dispatcher = new Dispatcher();
        return $dispatcher;
    }

    public function promiseTest(PromiseInterface $promise, callable $cb)
    {
        $err = null;

        $result = $promise->then($cb)
        ->then(function() {
            $this->loop->stop();
        },
        function($error) use(&$err) {
            $err = $error;
            $this->loop->stop();
        });

        $this->loop->run();

        if ($err) {
            $this->fail($err);
        }
    }

    /*******************************************
     * Actual tests
     ******************************************/

    /**
     * @test
     *
     * @covers ::__construct
     */
    public function canObtainInstance()
    {
        $controller = $this->makeController();

        $this->assertNotNull($controller);
    }

    /**
     * @test
     *
     * @covers ::index
     * @covers Aedart\React\Demo\Models\EventDrivenDNS::resolveHostNames
     * @covers Aedart\React\Demo\Models\EventDrivenDNS::resolveHostName
     */
    public function returnsListOfHostNames()
    {
        Debug::debug('Doing stuff...');

        $controller = $this->makeController();

        $promise = $controller->index();
        
        $this->promiseTest($promise, function ($hostNames) {

            Debug::debug('Asserting host names');

            $this->assertInternalType('array', $hostNames, 'host names not provided as a list');

            $this->assertNotEmpty($hostNames);

            Debug::debug('Asserting host elements');

            foreach ($hostNames as $host){
                $this->assertInstanceOf(Host::class, $host);
            }
            Debug::debug('Host test completed');
            //throw new \Exception('Impossible!!');
        });

    }

}