<?php namespace Aedart\React\Demo\Routes;

use Aedart\React\Demo\Contracts\Requests\Request;
use Aedart\React\Demo\Contracts\Routes\Router as RouterInterface;
use Aedart\React\Demo\Controllers\EventDNSController;
use Aedart\React\Demo\Traits\ServiceContainer;

/**
 * Class EventInputRouter
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\React\Demo\Routes
 */
class EventInputRouter implements RouterInterface
{
    use ServiceContainer;

    public function dispatch(Request $request)
    {
        // THIS IS JUST FOR THE DEMO... sends request to a different controller!

        // Obtain the controller - resolve its dependencies
        $controller = $this->getContainer()->make(EventDNSController::class);

        // Forward to the correct method
        $controller->index();
    }
}