<?php namespace Aedart\React\Demo\Contracts\DNS;

use React\Dns\Resolver\Resolver;

/**
 * Interface ResolverContainer
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\React\Demo\Contracts\DNS
 */
interface ResolverContainer
{
    /**
     * Returns a DNS resolver
     *
     * @return Resolver
     */
    public function getResolver();
}