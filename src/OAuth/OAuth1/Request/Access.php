<?php

namespace OAuth\OAuth1\Request;

use OAuth\OAuth1\Response;

class Access extends \OAuth\OAuth1\Request
{
    protected $name = 'access';

    protected $required = array(
        'oauth_consumer_key'     => TRUE,
        'oauth_token'            => TRUE,
        'oauth_signature_method' => TRUE,
        'oauth_signature'        => TRUE,
        'oauth_timestamp'        => TRUE,
        'oauth_nonce'            => TRUE,
        // 'oauth_verifier'         => TRUE,
        'oauth_version'          => TRUE,
    );

    public function execute(array $options = NULL)
    {
        return new Response(parent::execute($options));
    }

} // End Request_Access
