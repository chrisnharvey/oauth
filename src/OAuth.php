<?php

namespace OAuth;
/**
 * OAuth2.0
 *
 * @author Phil Sturgeon < @philsturgeon >
 */
class OAuth {

	/**
	 * Create a new provider.
	 *
	 *     // Load the Twitter provider
	 *     $provider = $this->oauth2->provider('twitter');
	 *
	 * @param   string $name    provider name
	 * @param   array  $options provider options
	 * @return  OAuth2_Provider
	 */
	public function __construct($name, array $options = NULL)
	{
		$name = ucfirst(strtolower($name));

		$class = 'OAuth\\Provider\\'.$name;

		return new $class($options);
	}

}