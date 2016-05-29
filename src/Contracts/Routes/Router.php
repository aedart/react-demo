<?php

namespace Aedart\React\Demo\Contracts\Routes;

use Aedart\React\Demo\Contracts\Requests\Request;

/**
 * Class InputRouter
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\React\Demo\Routes
 */
interface Router
{

    /**
     * Performs the routing logic and dispatches
     * the request to a controller
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function dispatch(Request $request);
}