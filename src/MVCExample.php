<?php namespace Aedart\React\Demo;

use Aedart\React\Demo\Contracts\DNS\ResolverContainer as ResolverContainerInterface;
use Aedart\React\Demo\DNS\ResolverContainer;
use Aedart\React\Demo\Factories\RequestFactory;
use Aedart\React\Demo\Routes\InputRouter;

/**
 * Class MVCExample
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\React\Demo
 */
class MVCExample extends Application
{
    public function setupApplication()
    {
        //
        // This application does the exact same thing as
        // \Aedart\React\Demo\DNSExample
        //
        // However, because we are DEALING WITH enterprise
        // architecture, making use of promises in such a
        // "simple" way is simply NOT GOOD ENOUGH.
        //
        // This example attempts to illustrate a MVC like
        // structure.
        //

        // 1) Setup application specific bindings... the DNS
        $this->setupAppBindings();

        // 2) Obtain the event loop ... YET, we don't needed for anything here...
        // TODO: request capturing should be part of the loop... not handled by this example
        $loop = $this->getEventLoop();

        // 3) Capture the current request
        $request = $this->captureRequest();

        // 4) Obtain the router and dispatch the request
        $this->router()->dispatch($request);
    }

    protected function setupAppBindings()
    {
        //
        // This also would go inside service providers
        //

        // There is sadly no interface available for the DNS resolver,
        // so we wrap it!
        $this->getContainer()->singleton(ResolverContainerInterface::class, function(){
            return new ResolverContainer();
        });
    }

    /**
     * Captures and returns the current request
     *
     * @return Requests\InputRequest
     */
    protected function captureRequest()
    {
        //
        // There are many ways to do this.
        //
        // a) Have a service provider, and ensure that in
        // its boot method, the correct request is created
        //
        // b) Have a static factory that does the same...
        //
        // In this example, the request is automatically
        // bound inside the IoC, so it can be obtained
        // using the "request" trait.
        //
        // NOTE: a request is always bound as a singleton!
        return RequestFactory::capture();
    }

    /**
     * @return InputRouter
     */
    protected function router()
    {
        //
        // The router could or perhaps should be obtained
        // via the IoC or a factory, because there would
        // be some differences between the way that input
        // and http requests should be processed.
        //

        return new InputRouter();
    }
}