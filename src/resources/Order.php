<?php

namespace VisaLogic\Resources;

class Order extends Resource
{
    protected $applications;

    /**
    *   Set all the resources properties passed through the constructor.
    *
    *   @param array  $data
    *
    *   @return void
    */
    public function __construct($data)
    {
        parent::__construct($data);

        $this->applications = [];
    }

    /**
    *   Add an application to the Order object.
    *
    *   @param array  $data
    *
    *   @return void
    */
    public function addApplication($data)
    {
        $this->applications = array_merge(
            $this->applications,
            [new Application($data)]
        );
    }
}
