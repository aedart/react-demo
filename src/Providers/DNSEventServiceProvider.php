<?php namespace Aedart\React\Demo\Providers;

use Aedart\React\Demo\Listeners\DoSomethingElseListener;
use Aedart\React\Demo\Listeners\WhenAllDone;
use Aedart\React\Demo\Listeners\WhenHostNamesResolved;
use Aedart\React\Demo\Listeners\WhenHostResolved;
use Aedart\React\Demo\Models\Events\HostNamesResolved;
use Aedart\React\Demo\Models\Events\HostResolved;
use Illuminate\Contracts\Events\Dispatcher as DispatcherInterface;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;

//use Illuminate\Events\EventServiceProvider; // CANNOT USE JUST LIKE SUCH...

/**
 * Class DNSEventServiceProvider
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\React\Demo\Providers
 */
class DNSEventServiceProvider extends ServiceProvider
{

    /**
     * The event listener mappings for everything that
     * has to do with DNS
     *
     * @var array
     */
    protected $listen = [
        HostNamesResolved::class => [
            WhenHostNamesResolved::class,
            WhenAllDone::class,
            SendToAdmin::class,
        ],

        HostResolved::class => [
            WhenHostResolved::class,
            DoSomethingElseListener::class
        ]
    ];

    //
    // This is just a typical setup - however, this can be
    // improved a lot, e.g. various other events for other
    // components of the system - e.g. semi automatic
    // registration from several other "event service providers"
    //

    public function register()
    {
        $this->app->singleton(DispatcherInterface::class, function ($app) {
            return new Dispatcher($app);
        });
    }

    public function boot(Dispatcher $eventDispatcher)
    {
        // Register all listeners for the the list of events...
        foreach($this->listens() as $event => $listeners){
            foreach($listeners as $listener){
                $eventDispatcher->listen($event, $listener);
            }
        }
    }

    /**
     * Get list of what is being listen for...
     *
     * @return array
     */
    public function listens()
    {
        return $this->listen;
    }
}