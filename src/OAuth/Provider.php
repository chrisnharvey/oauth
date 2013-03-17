<?php

namespace OAuth;

use OAuth1\Provider\ProviderInterface as OAuth1Provider;
use OAuth2\Provider\ProviderInterface as OAuth2Provider;
use Exception;
use InvalidArgumentException;

class Provider
{
    protected $version;
    protected $provider;

    public function __construct($provider)
    {
        if ($provider instanceof OAuth1Provider) $this->version = 1;
        if ($provider instanceof OAuth2Provider) $this->version = 2;

        if ( ! isset($this->version)) {
            throw new InvalidArgumentException('Provider must be an instance of OAuth1\Provider\ProviderInterface or OAuth2\Provider\ProviderInterface');
        }

        $this->provider = $provider;
    }

    public function process(callable $redirect, callable $callback)
    {
        return $this->version == 1
            ? $this->processOne($redirect, $callback)
            : $this->processTwo($redirect);
    }

    protected function processOne(callable $redirect, callable $callback)
    {
        if ($this->provider->isCallback()) {
            $this->provider->validateCallback($callback());

            return $this->provider;
        } else {
            $token = $this->provider->requestToken();

            $url = $this->provider->authorize($token);

            $redirect($url, $token);
        }
    }

    protected function processTwo(callable $process)
    {
        if ( ! $this->provider->isAuthenticated()) {
            $redirect($this->provider->getAuthenticationUrl());
        } else {
            return $this->provider;
        }
    }
}
