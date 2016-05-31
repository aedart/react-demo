<?php namespace Aedart\React\Demo;

use Aedart\React\Demo\Providers\DNSEventServiceProvider;
use Aedart\React\Demo\Routes\EventInputRouter;
use Aedart\React\Demo\Routes\InputRouter;
use Aedart\React\Demo\Traits\EventDispatcher;
use React\Promise\Deferred;
use React\Stream\Stream;

/**
 * Class EventExample
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\React\Demo
 */
class EventExample extends MVCExample
{
    use EventDispatcher;

    protected function setupAppBindings()
    {
        parent::setupAppBindings();

        // Register event service provider - as well as listeners
        // NOTE: service "boot" should be done a bit differently...
        $service = new DNSEventServiceProvider($this->getContainer());
        $service->register();
        $service->boot($this->getEventDispatcher());
    }

    public function fileGetContent($filename)
    {
        if(!file_exists($filename)){
            // exception...
            return;
        }

        $deferred = new Deferred();
        $filedata = '';
        $stream = new Stream(fopen($filename, 'r'), $this->getEventLoop());
        $stream->on('data', function($data, $stream) use(&$filedata) {
            $filedata .= $data;
        });
        $stream->on('end', function($stream) use($deferred, &$filedata) {
            $deferred->resolve($filedata);
        });
        $stream->on('error', function($error, $stream) use($deferred, &$filedata) {
            $deferred->reject($error);
        });
        return $deferred->promise();
    }

    /**
     * @return InputRouter
     */
    protected function router()
    {
        //
        // Using a different router - just sends the
        // request to a different kind of controller
        //

        return new EventInputRouter();
    }
}