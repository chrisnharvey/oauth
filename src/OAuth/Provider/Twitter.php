<?php

namespace OAuth\Provider;

use \OAuth\OAuth1\Token\Access;
use \OAuth\OAuth1\Consumer;
use \OAuth\OAuth1\Request\Resource;

class Twitter extends \OAuth\OAuth1\Provider
{

    public $name = 'twitter';
    
    public $uid_key = 'user_id';

    public function requestTokenUrl()
    {
        return 'https://api.twitter.com/oauth/request_token';
    }

    public function authorizeUrl()
    {
        return 'https://api.twitter.com/oauth/authorize';
    }

    public function accessTokenUrl()
    {
        return 'https://api.twitter.com/oauth/access_token';
    }
    
    public function getUserInfo(Consumer $consumer, Access $token)
    {       
        // Create a new GET request with the required parameters
        $request = new Resource('GET', 'http://api.twitter.com/1/users/lookup.json', array(
            'oauth_consumer_key' => $consumer->key,
            'oauth_token' => $token->access_token,
            'user_id' => $token->uid,
        ));

        // Sign the request using the consumer and token
        $request->sign($this->signature, $consumer, $token);

        $user = current(json_decode($request->execute()));
        
        // Create a response from the request
        return array(
            'uid' => $token->uid,
            'nickname' => $user->screen_name,
            'name' => $user->name ? $user->name : $user->screen_name,
            'location' => $user->location,
            'image' => $user->profile_image_url,
            'description' => $user->description,
            'urls' => array(
              'Website' => $user->url,
              'Twitter' => 'http://twitter.com/'.$user->screen_name,
            ),
        );
    }

} // End Provider_Twitter