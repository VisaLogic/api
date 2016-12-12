<?php

namespace VisaLogic;

use Http\Factory as Http;
use VisaLogic\Resources\Order;

class Api extends Kernel implements ApiContract
{
	protected $apiKey;

	/**
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
	*	The getOrders method is responsible for making a call to the API
	*	to retreive the comapanies orders.
	*
	*	@param $page (int)
	*	@return object
	**/
	public function getOrders($page = 1)
	{
		return $this->get('orders', ['page' => $page]);
	}

	/**
	*	The getOrder method gets an order by it's id.
	*
	*	@param $id (int)
	*	@return object
	**/
	public function getOrder($id)
	{
		return $this->get('orders', ['id' => $id]);
	}

	/**
	*	The createOrder method creates a new VisaLogic\Resources\Order instance
	*
	*	@param $data (array)
	*	@return VisaLogic\Resouces\Order object
	**/
	public function createOrder($data)
	{
		return new Order($data);
	}

	/**
	*	The postOrder method posts the order to the api server.
	*
	*	@param VisaLogic\Resources\Order $order
	*	@return object
	**/
	public function postOrder(Order $order)
	{
		return $this->post('orders', $order);
	}

	/**
	*	The getStatus method returns the status of an application
	*
	*	@param $application_id (int)
	*	@return string
	**/
	public function getStatus($application_id)
	{
		$result = $this->get('applications/status', ['id' => $application_id]);

		return $result->data->status;
	}

	/**
	*	The getViss method gets the pdf of an visa by it's id
	*
	*	@param int $application_id
	*	@return pdf
	**/
	public function getVisa($application_id)
	{
		$result = $this->get(
			'applications/download',
			['id' => $application_id],
			true
		);

		if(
			is_object(json_decode($result)) &&
			json_decode($result)->status != 'success'
		)
			return json_decode($result);

		header('Cache-Control: public');
		header('Content-type: application/pdf');
		header(
			'Content-Disposition: attachment; filename="' .
			$application_id .
			'.pdf"'
		);
		header('Content-Length: ' . strlen($result));

		return $result;
	}

	/**
	*	The getCountries method returns all countries from which can be
	*	applied from.
	*
	*	@return array
	**/
	function getCountries()
	{
		return [
			['NL' => 'Nederland'],
			['BE' => 'Belgie']
		];
	}

	/**
	*	The getNationalities method returns all nationalities which can
	*   apply for a visa.
	*
	*	@return array
	**/
	function getNationalities()
	{
		return [
			['NL' => 'Nederlandse'],
			['BE' => 'Belgische']
		];
	}

	/**
	*	The getDocumentTypes method returns all document types VisaLogic offers.
	*
	*	@return array
	**/
	function getNationalities()
	{
		return $this->get('document_types');
	}
}
