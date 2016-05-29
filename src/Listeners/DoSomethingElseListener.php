<?php namespace Aedart\React\Demo\Listeners;

use Aedart\React\Demo\Models\Events\HostResolved;

/**
 * Class DoSomethingElseListener
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\React\Demo\Listeners
 */
class DoSomethingElseListener
{
    public function handle(HostResolved $event)
    {
        // Do something with entire list of host names
        echo PHP_EOL . '   = ' . $event->host->getHostName() . PHP_EOL;
    }
}