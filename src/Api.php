<?php

namespace VisaLogic;

use Http\Factory as Http;
use VisaLogic\Resources\Order;

class Api extends Kernel implements ApiContract
{
	protected $apiKey;

	/**
	*
	*	The constructor is responsible for setting the $this->apiKey variable
	*
	*	@param (string) $apiKey
	*	@param (boolean) $setStatusCode
	*	@return void
	**/
	public function __construct($apiKey, $setStatusCode = true)
	{
		$this->apiKey = $apiKey;
		$this->setStatusCode = $setStatusCode;
	}

	/**
	*
	*	The getOrders method is responsible for making a call to the API
	*	to retreive the comapanies orders.
	*
	*	@param $apiKey
	*	@return $application_id
	**/
	public function getOrders()
	{
		return $this->get('orders');
	}

	/**
	*
	*	The getOrder method is gets an order by it's id.
	*
	*	@param $apiKey
	*	@return $application_id
	**/
	public function getOrder($id)
	{
		return $this->get('orders', ['id' => $id]);
	}
	
	public function createOrder($data)
	{
		return new Order($data);
	}

	public function postOrder($order)
	{
		return $this->post('orders', $order);
	}

	/**
	*
	*	The applyForVisa method is responsible for making the call to the API
	*	to apply for the visa.
	*
	*	@param $apiKey
	*	@return $application_id
	**/
	public function applyForVisa($personalia)
	{
		
	}

	public function getStatus($application_id)
	{

	}

	public function getVisaUrl($application_id)
	{

	}
	
	public function getVisaPlain($application_id)
	{

	}

	public function getRejectionReason($application_id)
	{

	}
}
