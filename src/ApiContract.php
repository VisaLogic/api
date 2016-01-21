<?php

namespace VisaLogic;

interface ApiContract {

	/**
	*
	*	The constructor is responsible for setting the $this->apiKey variable
	*
	*	@param (string) $apiKey
	*	@param (bool) $setStatusCode
	*	@return void
	**/
	public function __construct($apiKey, $setStatusCode);

	/**
	*
	*	The applyForVisa method is responsible for making the call to the API
	*	to apply for the visa.
	*
	*	@param $apiKey
	*	@return $application_id
	**/
	public function applyForVisa($personalia);

	/**
	*
	*	The getStatus method is responsible for retreiving the status of an
	*	visa that has been applied for.
	*
	*	@param $application_id
	*	@return string 'WAITING' | 'REJECTED' | 'APPROVED'
	**/
	public function getStatus($application_id);

	/**
	*
	*	The getVisaUrl method is responsible for retreiving the download
	*	url of an approved visa.
	*
	*	@param $application_id
	*	@return string $visa_url
	**/
	public function getVisaUrl($application_id);

	/**
	*
	*	The getVisaPlain method is responsible for retreiving the plain
	*	text visa document of an approved visa.
	*
	*	@param $application_id
	*	@return string $visa
	**/
	public function getVisaPlain($application_id);

	/**
	*
	*	The getRejectionReason method is responsible for retreiving the
	*	reason for a rejected visa.
	*
	*	@param $application_id
	*	@return string $visa_rejection_reason
	**/
	public function getRejectionReason($application_id);
}
