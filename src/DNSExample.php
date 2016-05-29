<?php namespace Aedart\React\Demo;

use React\Dns\Resolver\Factory;

/**
 * Class DNSExample
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\React\Demo
 */
class DNSExample extends Application
{
    public function setupApplication()
    {
        //
        // A very "simple" DNS example, from
        // https://blog.wyrihaximus.net/2015/02/reactphp-promises/
        //

        $loop = $this->getEventLoop();

        $dns = (new Factory())->create('8.8.8.8', $loop);
        $promises = [];

        $hosts = [
            'example.com',
            'blog.wyrihaximus.net',
            'wyrihaximus.net',
            'github.com',
            'google.com',
            'facebook.com',
        ];

        foreach($hosts as $host){

            //
            // WHAT THE FRACKING HELL!!!
            //
            // It appears that the dns->resolve actually returns
            // a promise. However, it is NOT documented at all!
            //
            $promises[] = $dns->resolve($host)
                ->then(function($ip) use ($host){
                    print "IP for $host is $ip" . PHP_EOL;
                    return $host;
                });
        }

        \React\Promise\all($promises)->then(function($hostNames){
            echo 'Done: ' . implode(', ', $hostNames) . '~' . PHP_EOL;
        });
    }
}