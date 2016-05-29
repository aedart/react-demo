<?php namespace Aedart\React\Demo\Controllers;

use Aedart\React\Demo\Exceptions\NoHostNamesProvidedException;
use Aedart\React\Demo\Models\DNS;

/**
 * DNS Controller
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\React\Demo\Controllers
 */
class DNSController extends ControllerBase
{
    /**
     * @var DNS|null
     */
    protected $dns = null;

    public function __construct(DNS $dns)
    {
        $this->dns = $dns;
    }
    
    public function index()
    {
        // Obtain the host names
        $hostNames = $this->getRequest()->getData();

        // TODO: Could be done before ever reaching this point, e.g. Laravel style...
        if(empty($hostNames)){

            //
            // An exception handler would have to take care of this,
            // and eventually just create a new response object,
            // with a 422 header
            //

            throw new NoHostNamesProvidedException();
        }

        // Invoke some "heavy" method on model
        $this->dns->resolveHostNames($hostNames)
        ->then(function($hostNames){
            // Assign to view logic... in this case, just output!
            echo 'Done: ' . PHP_EOL . implode(PHP_EOL, $hostNames) . PHP_EOL;
        });
    }
    
}