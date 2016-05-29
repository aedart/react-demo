<?php namespace Aedart\React\Demo\Models\Events;

use Aedart\React\Demo\Models\Host;

/**
 * Host Names Resolved
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\React\Demo\Models\Events
 */
class HostNamesResolved
{

    /**
     * @var \Aedart\React\Demo\Models\Host[]|array
     */
    public $hostNames = [];

    /**
     * HostNamesResolved constructor.
     *
     * @param Host[] $hostNames
     */
    public function __construct(array $hostNames = [])
    {
        $this->hostNames = $hostNames;
    }

}