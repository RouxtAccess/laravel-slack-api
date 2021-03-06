<?php

namespace RouxtAccess\SlackApi\Contracts;

interface SlackApi
{
    public function get($apiMethod, $parameters = []);

    public function post($apiMethod, $parameters = []);

    public function delete($apiMethod, $parameters = []);

    public function put($apiMethod, $parameters = []);

    public function patch($apiMethod, $parameters = []);
}
