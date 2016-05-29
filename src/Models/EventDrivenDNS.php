<?php namespace Aedart\React\Demo\Models;

use Aedart\React\Demo\Contracts\DNS\ResolverContainer;
use Aedart\React\Demo\Models\Events\HostNamesResolved;
use Aedart\React\Demo\Models\Events\HostResolved;
use Aedart\React\Demo\Traits\EventDispatcher;
use React\Promise\PromiseInterface;

/**
 * Class EventDrivenDNS
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\React\Demo\Models
 */
class EventDrivenDNS
{
    use EventDispatcher;

    /**
     * @var \React\Dns\Resolver\Resolver
     */
    protected $dns = null;

    public function __construct(ResolverContainer $DNSResolverContainer)
    {
        $this->dns = $DNSResolverContainer->getResolver();
    }

    /**
     * Due to the DNS resolver... still using those promises,
     * but now we a dispatch an event when it is completed!
     *
     * @param array $hostNames
     * @param string $onCompleteEvent [optional]
     *
     * @return PromiseInterface
     */
    public function resolveHostNames(array $hostNames, $onCompleteEvent = HostNamesResolved::class)
    {
        $promises = [];

        foreach($hostNames as $host){

            // Could we actually just had listened internally for when
            // a host name has been resolved, and then do something,
            // instead of dealing with promises?
            $promises[] = $this->resolveHostName($host);
        }

        return \React\Promise\all($promises)->then(function($hostNames) use ($onCompleteEvent){
            // Is this then going to be "blocking"?
            $this->getEventDispatcher()->fire(new $onCompleteEvent($hostNames));

            //return \React\Promise\resolve($hostNames); // Is this needed or not?
            return $hostNames;
        });
    }

    /**
     * Almost same example here... except that we chain
     * the event triggering as the last part of the
     * promise chain
     *
     * @param string $hostName
     * @param string $onCompleteEvent [optional]
     *
     * @return PromiseInterface
     */
    public function resolveHostName($hostName, $onCompleteEvent = HostResolved::class)
    {
        return $this->dns->resolve($hostName)
            ->then(function($ip) use ($hostName){
                return new Host($ip, $hostName);
            })
            ->then(function(Host $host) use ($onCompleteEvent){
                $this->getEventDispatcher()->fire(new $onCompleteEvent($host));

                return $host;
            });
    }
}