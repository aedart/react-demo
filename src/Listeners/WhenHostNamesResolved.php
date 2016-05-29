<?php namespace Aedart\React\Demo\Listeners;

use Aedart\React\Demo\Models\Events\HostNamesResolved;

/**
 * Class WhenHostNamesResolved
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\React\Demo\Listeners
 */
class WhenHostNamesResolved
{

    public function handle(HostNamesResolved $event)
    {
        // Do something with entire list of host names
        echo PHP_EOL . 'Done: ' . PHP_EOL . implode(PHP_EOL, $event->hostNames) . PHP_EOL;
    }
    
}