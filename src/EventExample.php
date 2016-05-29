<?php namespace Aedart\React\Demo;

use Aedart\React\Demo\Providers\DNSEventServiceProvider;
use Aedart\React\Demo\Routes\EventInputRouter;
use Aedart\React\Demo\Routes\InputRouter;
use Aedart\React\Demo\Traits\EventDispatcher;

/**
 * Class EventExample
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\React\Demo
 */
class EventExample extends MVCExample
{
    use EventDispatcher;

    protected function setupAppBindings()
    {
        parent::setupAppBindings();

        // Register event service provider - as well as listeners
        // NOTE: service "boot" should be done a bit differently...
        $service = new DNSEventServiceProvider($this->getContainer());
        $service->register();
        $service->boot($this->getEventDispatcher());
    }

    /**
     * @return InputRouter
     */
    protected function router()
    {
        //
        // Using a different router - just sends the
        // request to a different kind of controller
        //

        return new EventInputRouter();
    }
}