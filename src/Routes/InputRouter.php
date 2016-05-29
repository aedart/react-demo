<?php namespace Aedart\React\Demo\Routes;

use Aedart\React\Demo\Contracts\Requests\Request;
use Aedart\React\Demo\Contracts\Routes\Router as RouterInterface;
use Aedart\React\Demo\Controllers\DNSController;
use Aedart\React\Demo\Traits\ServiceContainer;

/**
 * Class InputRouter
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\React\Demo\Routes
 */
class InputRouter implements RouterInterface
{
    use ServiceContainer;

    public function dispatch(Request $request)
    {
        //
        // Here you would perform your routing
        // logic which ultimately should
        // create a new controller instance and
        // pass the request to it!
        //

        // TODO: Apply middleware filters for the given route!
        // TODO: ... well, not implemented in this example ...

        // Obtain the controller - resolve its dependencies
        $controller = $this->getContainer()->make(DNSController::class);

        // Forward to the correct method
        $controller->index();
    }

}