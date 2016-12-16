<?php

namespace VisaLogic;

use Http\Factory as Http;
use VisaLogic\Resources\Order;

class Api extends Kernel implements ApiContract
{
    protected $apiKey;

    /**
     * Set the $apiKey and setStatusCode properties
     *
     * @param  string   $apiKey
     * @param  boolean  $setStatusCode
     * @return void
     */
    public function __construct($apiKey, $setStatusCode = true)
    {
        $this->apiKey = $apiKey;
        $this->setStatusCode = $setStatusCode;
    }

    /**
     * Retreive the company's orders.
     *
     * @param  int  $page
     * @return object
     */
    public function getOrders($page = 1)
    {
        return $this->get('orders', ['page' => $page]);
    }

    /**
     * Get an order by it's id.
     *
     * @param  int  $id
     * @return object
     */
    public function getOrder($id)
    {
        return $this->get('orders', ['id' => $id]);
    }

    /**
     * Create a new VisaLogic\Resources\Order instance.
     *
     * @param  array  $data
     * @return VisaLogic\Resouces\Order
     */
    public function createOrder($data)
    {
        return new Order($data);
    }

    /**
     * Post the order to the api server.
     *
     * @param  VisaLogic\Resources\Order  $order
     * @return object
     */
    public function postOrder(Order $order)
    {
        return $this->post('orders', $order);
    }

    /**
     * Retreive the status of an application.
     *
     * @param  int  $application_id
     * @return string
     */
    public function getStatus($application_id)
    {
        $result = $this->get('applications/status', ['id' => $application_id]);

        return $result->data->status;
    }

    /**
     * Get the pdf of an visa by it's id and set the headers.
     *
     * @param  int  $application_id
     * @return pdf
     */
    public function getVisa($application_id)
    {
        $result = $this->get(
            'applications/download',
            ['id' => $application_id],
            true
        );

        if (
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
     * Return all countries from which can be applied from.
     *
     * @return array
     */
    function getCountries()
    {
        return [
            'NL' => 'Nederland',
            'BE' => 'Belgie'
        ];
    }

    /**
     * Return all nationalities which can apply for a visa.
     *
     * @return array
     */
    function getNationalities()
    {
        return [
            'NL' => 'Nederlandse',
            'BE' => 'Belgische'
        ];
    }

    /**
     * Retreive all document types VisaLogic supports.
     *
     * @return array
     */
    function getDocumentTypes()
    {
        return $this->get('document_types');
    }
}
