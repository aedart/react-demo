<?php namespace Aedart\React\Demo\Listeners;

use Aedart\React\Demo\Models\Events\HostNamesResolved;

/**
 * Class WhenAllDone
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\React\Demo\Listeners
 */
class WhenAllDone
{
    public function handle(HostNamesResolved $event)
    {
        // Other very important business logic...
        echo PHP_EOL . 'Sending list of hosts to admin... You\'r welcome!' . PHP_EOL . PHP_EOL;
    }
}