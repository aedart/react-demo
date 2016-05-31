<?php namespace Aedart\React\Demo\Models;

use Aedart\React\Demo\Contracts\DNS\ResolverContainer;
use React\Promise\Deferred;
use React\Promise\PromiseInterface;

/**
 * A DNS model
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\React\Demo\Models
 */
class DNS
{
    /**
     * @var null|\React\Dns\Resolver\Resolver
     */
    protected $dns = null;

    public function __construct(ResolverContainer $DNSResolverContainer)
    {
        $this->dns = $DNSResolverContainer->getResolver();
    }

    /**
     * ...omg - why can't this JUST return the value
     * NOT EASILY TESTED!
     *
     * @param array $hostNames
     *
     * @return PromiseInterface
     */
    public function resolveHostNames(array $hostNames)
    {
        $promises = [];
        $deferred = new Deferred();

        foreach($hostNames as $host){

            $promises[] = $this->resolveHostName($host);
        }

        \React\Promise\all($promises)->then(function($hostNames) use($deferred) {
            $deferred->resolve($hostNames);
        });

        return $deferred->promise();
    }

    /**
     * ...omg - why can't this JUST return the value
     * NOT EASILY TESTED!
     *
     * @param string $hostName
     *
     * @return PromiseInterface
     */
    public function resolveHostName($hostName)
    {
        return $this->dns->resolve($hostName)
            ->then(function($ip) use ($hostName){
                return new Host($ip, $hostName);
            });
    }
}