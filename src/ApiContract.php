<?php

namespace VisaLogic;

interface ApiContract {
	/**
	*	The constructor is responsible for setting the $apiKey and
	*   $setStatusCode properties
	*
	*	@param (string) $apiKey
	*	@param (bool) $setStatusCode
	*	@return void
	**/
	public function __construct($apiKey, $setStatusCode);

	/**
	*	The getOrders method is responsible for making a call to the API
	*	to retreive the comapanies orders.
	*
	*	@param $page (int)
	*	@return object
	**/
	public function getOrders($page = 1);

	/**
	*	The getOrder method gets an order by it's id.
	*
	*	@param $id (int)
	*	@return object
	**/
	public function getOrder($id);

	/**
	*	The createOrder method creates a new VisaLogic\Resources\Order instance
	*
	*	@param $data (array)
	*	@return VisaLogic\Resouces\Order object
	**/
	public function createOrder($data);

	/**
	*	The postOrder method posts the order to the api server.
	*
	*	@param VisaLogic\Resources\Order $order
	*	@return object
	**/
	public function postOrder(\VisaLogic\Resources\Order $order);

	/**
	*	The getStatus method returns the status of an application
	*
	*	@param $application_id (int)
	*	@return string
	**/
	public function getStatus($application_id);

	/**
	*	The getVisa method gets the pdf of an visa by it's id
	*
	*	@param int $application_id
	*	@return pdf
	**/
	public function getVisa($application_id);

	/**
	*	The getCountries method returns all countries from which can be
	*	applied from.
	*
	*	@return array
	**/
	public function getCountries();

	/**
	*	The getNationalities method returns all nationalities which can
	*   apply for a visa.
	*
	*	@return array
	**/
	function getNationalities();
}
