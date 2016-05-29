<?php namespace Aedart\React\Demo\Factories;

use Aedart\React\Demo\Containers\IoC;
use Aedart\React\Demo\Contracts\Requests\Request;
use Aedart\React\Demo\Requests\InputRequest;

/**
 * Class RequestFactory
 *
 * Responsible for capturing requests and returns the
 * concrete request implementation
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\React\Demo\Factories
 */
class RequestFactory
{
    static public function capture()
    {
        // For the sake of the example, we create a populated
        // request object.
        $request = new InputRequest([
            'example.com',
            'blog.wyrihaximus.net',
            'wyrihaximus.net',
            'github.com',
            'google.com',
            'facebook.com',
        ]);

        // TODO: Nice, if requests need to be obtained in many parts of the system!
        // Obtain the ioc
        $ioc = IoC::getInstance()->getContainer();

        // Clear out any eventual previous request binding!
        if(isset($ioc[Request::class])){
            unset($ioc[Request::class]);
        }

        // We now must bind the current request to the IoC
        $ioc->singleton(Request::class, function($ioc) use ($request){
            return $request;
        });

        // Finally return it
        return $request;
    }

}