<?php

namespace RouxtAccess\SlackApi\Methods;

use RouxtAccess\SlackApi\Contracts\SlackApi;

abstract class SlackMethod
{
    /**
     * Prefix of the api methods to allow you to use short method names.
     * @var string
     */
    protected $methodsGroup = 'api.';

    /**
     * @var \RouxtAccess\SlackApi\Contracts\SlackApi
     */
    protected $api;

    /**
     * @param \RouxtAccess\SlackApi\Contracts\SlackApi  $api
     */
    public function __construct(SlackApi $api)
    {
        $this->api = $api;
    }

    /**
     * Sends a http request.
     *
     * @param string $method short method of the api (only the suffix after ".")
     * @param array  $params params to the given method
     * @param string $http http verb
     *
     * @return array
     */
    public function method($method, $params = [], $http = 'post')
    {
        return call_user_func([$this->getApi(), $http], $this->methodsGroup.$method, $params);
    }

    /**
     * Returns the api.
     * @return \RouxtAccess\SlackApi\Contracts\SlackApi
     */
    public function getApi()
    {
        return $this->api;
    }

}
