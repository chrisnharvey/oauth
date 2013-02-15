<?php

namespace OAuth\OAuth1\Request;

use \OAuth\OAuth1\Response;

class Token extends \OAuth\OAuth1\Request
{

    protected $name = 'request';

    // http://oauth.net/core/1.0/#rfc.section.6.3.1
    protected $required = array(
        'oauth_callback'         => TRUE,
        'oauth_consumer_key'     => TRUE,
        'oauth_signature_method' => TRUE,
        'oauth_signature'        => TRUE,
        'oauth_timestamp'        => TRUE,
        'oauth_nonce'            => TRUE,
        'oauth_version'          => TRUE,
    );

    public function execute(array $options = NULL)
    {
        return new Response(parent::execute($options));
    }

} // End Request_Token
