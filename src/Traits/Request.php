<?php namespace Aedart\React\Demo\Traits;

use Aedart\React\Demo\Containers\IoC;
use Aedart\React\Demo\Contracts\Requests\Request as RequestInterface;

/**
 * Trait Request
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\React\Demo\Traits
 */
trait Request
{
    /**
     * Instance of the current request
     *
     * @var RequestInterface|null
     */
    protected $request = null;

    /**
     * Set the given request
     *
     * @param RequestInterface $request Instance of the current request
     *
     * @return void
     */
    public function setRequest(RequestInterface $request)
    {
        $this->request = $request;
    }

    /**
     * Get the given request
     *
     * If no request has been set, this method will
     * set and return a default request, if any such
     * value is available
     *
     * @see getDefaultRequest()
     *
     * @return RequestInterface|null request or null if none request has been set
     */
    public function getRequest()
    {
        if (!$this->hasRequest() && $this->hasDefaultRequest()) {
            $this->setRequest($this->getDefaultRequest());
        }
        return $this->request;
    }

    /**
     * Get a default request value, if any is available
     *
     * @return RequestInterface|null A default request value or Null if no default value is available
     */
    public function getDefaultRequest()
    {
        return IoC::make(RequestInterface::class);
    }

    /**
     * Check if request has been set
     *
     * @return bool True if request has been set, false if not
     */
    public function hasRequest()
    {
        return !is_null($this->request);
    }

    /**
     * Check if a default request is available or not
     *
     * @return bool True of a default request is available, false if not
     */
    public function hasDefaultRequest()
    {
        return !is_null($this->getDefaultRequest());
    }
}