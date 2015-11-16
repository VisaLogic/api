<?php

namespace VisaLogic;

class Api implements ApiContract
{
	protected $apiKey;

	/**
	*
	*	The constructor is responsible for setting the $this->apiKey variable
	*
	*	@param $apiKey
	*	@return void
	**/
	public function __construct($apiKey)
	{
		$this->apiKey = $apiKey;
	}

	/**
	*
	*	The applyForVisa method is responsible for making the call to the API
	*	to apply for the visa.
	*
	*	@param $apiKey
	*	@return $application_id
	**/
	public function applyForVisa($personalia) {
		
	}
}
