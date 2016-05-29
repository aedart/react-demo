<?php namespace Aedart\React\Demo\Listeners;

use Aedart\React\Demo\Models\Events\HostResolved;

/**
 * Class WhenHostResolved
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\React\Demo\Listeners
 */
class WhenHostResolved
{
    public function handle(HostResolved $event)
    {
        // Do something with the host...
        echo PHP_EOL . ' - processed ' . $event->host->getIp();
    }

}