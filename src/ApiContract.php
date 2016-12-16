<?php

namespace VisaLogic;

interface ApiContract {
    /**
     * Set the $apiKey and setStatusCode properties
     *
     * @param  string   $apiKey
     * @param  boolean  $setStatusCode
     * @return void
     */
    public function __construct($apiKey, $setStatusCode);

    /**
     * Retreive the company's orders.
     *
     * @param  int  $page
     * @return object
     */
    public function getOrders($page = 1);

    /**
     * Get an order by it's id.
     *
     * @param  int  $id
     * @return object
     */
    public function getOrder($id);

    /**
     * Create a new VisaLogic\Resources\Order instance.
     *
     * @param  array  $data
     * @return VisaLogic\Resouces\Order
     */
    public function createOrder($data);

    /**
     * Post the order to the api server.
     *
     * @param  VisaLogic\Resources\Order  $order
     * @return object
     */
    public function postOrder(\VisaLogic\Resources\Order $order);

    /**
     * Retreive the status of an application.
     *
     * @param  int  $application_id
     * @return string
     */
    public function getStatus($application_id);

    /**
     * Get the pdf of an visa by it's id and set the headers.
     *
     * @param  int  $application_id
     * @return pdf
     */
    public function getVisa($application_id);

    /**
     * Return all countries from which can be applied from.
     *
     * @return array
     */
    public function getCountries();

    /**
     * Return all nationalities which can apply for a visa.
     *
     * @return array
     */
    public function getNationalities();

    /**
     * Retreive all document types VisaLogic supports.
     *
     * @return array
     **/
    function getDocumentTypes();
}
