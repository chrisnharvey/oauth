<?php

namespace OAuth;

use \Guzzle\Http\Client;
use \OAuth\OAuth1\Token\Access as OAuth1Token;
use \OAuth\OAuth2\Token\Access as OAuth2Token;
use \Exception;

class OAuthClient extends Client
{
	protected $tokens;

    public function setUserTokens($tokens)
    {
    	if (! ($tokens instanceof OAuth1Token)
    		and ! ($tokens instanceof OAuth2Token)) {

    		throw new Exception('User tokens must be an instance of OAuth\OAuth1\Token\Access or OAuth\OAuth2\Token\Access');
    	}
    	
        $this->tokens = $tokens;
    }
}
