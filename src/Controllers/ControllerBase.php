<?php namespace Aedart\React\Demo\Controllers;

use Aedart\React\Demo\Contracts\Controllers\Controller;
use Aedart\React\Demo\Traits\Request;
use Aedart\React\Demo\Traits\ServiceContainer;

/**
 * Class ControllerBase
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\React\Demo\Controllers
 */
abstract class ControllerBase implements Controller
{
    use ServiceContainer;
    use Request;
}