<?php namespace Aedart\React\Demo\DNS;

use Aedart\React\Demo\Contracts\DNS\ResolverContainer as ResolverContainerInterface;
use Aedart\React\Demo\Traits\EventLoop;
use React\Dns\Resolver\Factory;
use React\Dns\Resolver\Resolver;

/**
 * Class ResolverContainer
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\React\Demo\DNS
 */
class ResolverContainer implements ResolverContainerInterface
{
    use EventLoop;

    protected $resolver = null;

    /**
     * Returns a DNS resolver
     *
     * @return Resolver
     */
    public function getResolver()
    {
        if(null === $this->resolver){
            //
            // Could had been a singleton... could accept name server.
            // Lots of ways this could had been instantiated.
            //
            $this->resolver = (new Factory())->create('8.8.8.8', $this->getEventLoop());
        }

        return $this->resolver;
    }
}