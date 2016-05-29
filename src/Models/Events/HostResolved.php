<?php namespace Aedart\React\Demo\Models\Events;

use Aedart\React\Demo\Models\Host;

/**
 * Class HostResolved
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\React\Demo\Models\Events
 */
class HostResolved
{
    /**
     * @var Host|null
     */
    public $host = null;

    /**
     * HostResolved constructor.
     *
     * @param Host $host
     */
    public function __construct(Host $host)
    {
        $this->host = $host;
    }
}